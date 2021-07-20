<?php

namespace App\Controller;

use App\Repository\JanreRepository;
use App\Form\AddForm;
use App\Form\UserFilterType;
use App\Entity\User;
use App\Entity\History;
use App\Entity\Films;
use App\Entity\Janre;
use App\Repository\HistoryRepository;
use App\Repository\FilmsRepository;
use App\Repository\ChildFilterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Datetime;

#[Route('/films')]
class FilmsController extends AbstractController
{
	
	
    #[Route('/', name: 'films_index', methods: ['GET', 'POST'])]
    public function index(FilmsRepository $filmsRepository, ChildFilterRepository $childFilterRepository, Request $request): Response
    {
		$filmfilter = new Films();
		$form = $this->createForm(UserFilterType::class, $filmfilter);
        $form->handleRequest($request);
		$film = Null;
		$filter= $this->getUser()->getFilter();
		if ($filter){
			$film = $filmsRepository->findAll();
			$film = array_filter($film, function($farr) use($filter){
				return ($farr->getAgeLimit()<$filter->getMaxAgeLimit()) && ($farr->getYear()>$filter->getMaxYear());
				});
			if (!$filter->getJanreFilterId()->isEmpty())	{
			$film = array_filter($film, function($farr) use($filter){
				foreach ($farr->getJanres() as $filmJanre) {
					foreach($filter->getJanreFilterId() as $filterJanre){
					if($filterJanre->getId() == $filmJanre->getId()){
						return true;
					}
					}
				}
				return false;
				});
			}
		}else{
			$film = $filmsRepository->findAll();
		}
		
		if ($form->isSubmitted() && $form->isValid()) {
			$film = $filmsRepository->findAll();
			
			if ($form->get('film_name')->getData()){
				$namefilter = $form->get('film_name')->getData();
				$film = array_filter($film, function($farr) use($namefilter){
				return ($farr->getFilmName()== $namefilter);
				});
			}
			
			if ($form->get('director')->getData()){
				$dirfilter = $form->get('director')->getData();
				$film = array_filter($film, function($farr) use($dirfilter){
				return ($farr->getDirector()== $dirfilter);
				});
			}
			
			if ($form->get('year')->getData()){
				$yearfilter = $form->get('year')->getData();
				$film = array_filter($film, function($farr) use($yearfilter){
				return ($farr->getYear()== $yearfilter);
				});
			}
			
			if ($form->get('age_limit')->getData()){
				$agefilter = $form->get('age_limit')->getData();
				$film = array_filter($film, function($farr) use($agefilter){
				return ($farr->getAgeLimit()>= $agefilter);
				});
			}
			
			if (!$filmfilter->getJanres()->isEmpty()){
			$film = array_filter($film, function($farr) use($filmfilter){
				foreach ($farr->getJanres() as $filmJanre) {
					foreach($filmfilter->getJanres() as $filterJanre){
					if($filterJanre->getId() == $filmJanre->getId()){
						return true;
					}
					}
				}
				return false;
				});
			}
			
            return $this->render('films/index.html.twig', [
			'UserFilterType' => $form->createView(),
            'films' => $film
			]);
        }
		
        return $this->render('films/index.html.twig', [
			'UserFilterType' => $form->createView(),
            'films' => $film
        ]);
    }

    #[Route('/new', name: 'films_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        
        $film = new Films();
        $form = $this->createForm(AddForm::class, $film);
        $form->handleRequest($request);
		
		
		if ($form->isSubmitted() && $form->isValid()) {
			
          /* $genre = $this->getDoctrine()
			->getRepository(Janre::class)
			->findByField($form->get('janres')->getData());
			
			foreach ($genre as &$value) {
			$film->addJanre($value);
			}*/
			/*$genre = new Janre;
			$film->addJanre($genre);
			$film->setFilmName($form->get('film_name')->getData());
			$film->setYear($form->get('year')->getData());
			$film->setAgeLimit($form->get('age_limit')->getData());
			$film->setDescription($form->get('description')->getData());
			$film->setDirector($form->get('director')->getData());
			$film->setFilename($form->get('filename')->getData());
			$film->setPicture($form->get('picture')->getData());*/
			
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($film);
            $entityManager->flush();
			 $this->addFlash(
            'notice',
            'Фильм успешно добавлен!'
			);
            // do anything else you need here, like send an email

             return $this->redirectToRoute('films_index');
        }else{
			$this->addFlash(
            'notice',
            'Произошла ошибка!'
			);
		}

        return $this->render('films/new.html.twig', [
            'AddForm' => $form->createView(),
        ]);
    }
	
    #[Route('/{id}', name: 'films_show', methods: ['GET'])]
    public function show(Films $film): Response
    {
		
		$history = new History;
		$history->setTimer(new DateTime('NOW'));
		$history->setFilm($film);
		$history->setUser($this->getUser());
		$entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($history);
        $entityManager->flush();
        return $this->render('films/show.html.twig', [
            'film' => $film,
        ]);
    }

    #[Route('/{id}/edit', name: 'films_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Films $film): Response
    {
        $form = $this->createForm(AddForm::class, $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('films_index');
        }

        return $this->render('films/edit.html.twig', [
            'film' => $film,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'films_delete', methods: ['POST'])]
    public function delete(Request $request, Films $film): Response
    {
        if ($this->isCsrfTokenValid('delete'.$film->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($film);
            $entityManager->flush();
        }

        return $this->redirectToRoute('films_index');
    }
}
