<?php
namespace App\Controller;

use App\Entity\User;
//use App\Entity\History;
use App\Repository\UserRepository;
use App\Form\RegistrationFormType;
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

class HomePageController extends AbstractController
{
    /**
     * @Route("/home", name="homepage")
     */
    public function index(UserRepository $userRepository): Response
    {
		
	if ($this->getUser()->getChildID()){
		$child = $userRepository->find($this->getUser()->getChildID());
	}else{
		$child = Null;
	}
        return $this->render('homepage.html.twig', [
		'child' => $child,
        ]);
    }
	
	 /**
     * @Route("/home/statistic", name="statistic")
     */
    public function stats(): Response
    {
        return $this->render('statistic.html.twig', [
        ]);
    }
	
	
 /*   public function removeHis(UserRepository $userRepository): Response
    {
		$his = new History;
		$his= $userRepository->find($this->getUser()->getHistories());
		$entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($his);
        $entityManager->flush();
	if (!$his){	
	if ($this->getUser()->getChildID()){
	$child = $userRepository->find($this->getUser()->getChildID());
	}else{
		$child = Null;
	}
		
        return $this->render('homepage.html.twig', [
		'child' => $child,
        ]);
	}else{
		return $this->render('statistic.html.twig', [
        ]);
		
	}
	}*/
}