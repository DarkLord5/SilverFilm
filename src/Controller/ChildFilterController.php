<?php

namespace App\Controller;

use App\Form\FilterType;
use App\Entity\ChildFilter;
use App\Entity\Janre;
use App\Repository\ChildFilterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ChildFilterController extends AbstractController
{
   /* #[Route('/', name: 'films_index', methods: ['GET'])]
    public function index(FilmsRepository $filmsRepository): Response
    {
        return $this->render('films/index.html.twig', [
            'films' => $filmsRepository->findAll(),
        ]);
    }*/

    #[Route('/newfilter', name: 'filter_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        
        $filter = new ChildFilter();
        $form = $this->createForm(FilterType::class, $filter);
        $form->handleRequest($request);
		
		
		if ($form->isSubmitted() && $form->isValid()) {
			
         
			
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($filter);
            $entityManager->flush();
			 $this->addFlash(
            'notice',
            'Фильтр успешно добавлен!'
			);
            // do anything else you need here, like send an email

             return $this->redirect('child/new'.$filter->getId(), 301);
        }else{
			$this->addFlash(
            'notice',
            'Произошла ошибка!'
			);
		}

        return $this->render('addfilter.html.twig', [
            'FilterType' => $form->createView(),
        ]);
    }
	 #[Route('/{id}/edit', name: 'filter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ChildFilter $filter): Response
    {
        $form = $this->createForm(FilterType::class, $filter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('filter/editfilter.html.twig', [
            'filter' => $filter,
            'form' => $form->createView(),
        ]);
		
    }
	


        
}
