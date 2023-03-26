<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\UserType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Repository\RolsRepository;

class RegistrationController extends AbstractController
{
    private $keyController;
    private $rolsRepository;
    public function __construct(KeyController $keyController, RolsRepository $rolsRepository)
    {
        $this->keyController = $keyController;
        $this->rolsRepository = $rolsRepository;
    }

     #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form_user = $this->createForm(UserType::class, $user);
        $form_user->handleRequest($request);
        $rols= $this->rolsRepository->findAll();
        if ($form_user->isSubmitted() && $form_user->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user, 
                    $form_user->get('password')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/createUser.html.twig', [
            'form_user' => $form_user->createView(),
            'rols'=>$rols        
           
        ]);
    }
}
