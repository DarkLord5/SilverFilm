<?php

namespace App\Controller;

use App\Entity\ChildFilter;
use App\Entity\User;
use App\Entity\Child;
use App\Form\ChildType;
use App\Repository\UserRepository;
use App\Security\AppAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/child')]
class ChildController extends AbstractController
{
    #[Route('/', name: 'child_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('child/index.html.twig', [
            'children' => $userRepository->findAllByRoleCHILD(),
        ]);
    }

    #[Route('/new{id}', name: 'child_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AppAuthenticator $authenticator, ChildFilter $filter): Response
    {
		$id=$this->getUser()->getId();
		$childUser = new User();
        $form = $this->createForm(ChildType::class, $childUser);
        $form->handleRequest($request);
		
        if ($form->isSubmitted() && $form->isValid()) {
			$childUser->setFilter($filter);
			$childUser->setRoles(['ROLE_CHILD']);
			$childUser->setParentID($id);
			$childUser->setPassword($form->get('plainPassword')->getData());
            $childUser->setPassword(
                $passwordEncoder->encodePassword(
                    $childUser,
                    $form->get('plainPassword')->getData()
                )
            );
			
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($childUser);
			
            $entityManager->flush();
			$user= $this->getUser();
			$user->setChildID($childUser->getId());
			$entityManager1 = $this->getDoctrine()->getManager();
            $entityManager1->persist($user);
			$entityManager1->flush();
			
            return $this->redirectToRoute('homepage');
        }

        return $this->render('child/new.html.twig', [
            'child' => $childUser,
            'ChildType' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'child_show', methods: ['GET'])]
    public function show(User $child): Response
    {
        return $this->render('child/show.html.twig', [
            'child' => $child,
        ]);
    }

    #[Route('/{id}/edit', name: 'child_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $child): Response
    {
        $form = $this->createForm(ChildType::class, $child);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('child_index');
        }

        return $this->render('child/edit.html.twig', [
            'child' => $child,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'child_delete', methods: ['POST'])]
    public function delete(Request $request, User $child): Response
    {
        if ($this->isCsrfTokenValid('delete'.$child->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($child);
            $entityManager->flush();
        }

        return $this->redirectToRoute('child_index');
    }
}
