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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use App\Security\EmailVerifier;

use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class RegistrationController extends AbstractController
{
    private $keyController;
    private $rolsRepository;
    private $verifyEmailHelper;
    private $mailer;
    private $userRepository;
    private EmailVerifier $emailVerifier;
    public function __construct(EmailVerifier $emailVerifier, UserRepository $userRepository, KeyController $keyController, RolsRepository $rolsRepository, VerifyEmailHelperInterface $helper)
    {
        $this->keyController = $keyController;
        $this->rolsRepository = $rolsRepository;
        $this->verifyEmailHelper = $helper;
        $this->emailVerifier = $emailVerifier;
        $this->userRepository = $userRepository;
    }



    #[Route('/register', name: 'app_register')]
    public function register(MailerInterface $mailer, Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form_user = $this->createForm(UserType::class, $user);
        $form_user->handleRequest($request);
        $rols = $this->rolsRepository->findAll();
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
           
            
            $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $user,
                (new TemplatedEmail())
                    ->from('cubamodela.test@gmail.com')
                    ->to($user->getEmail())
                    ->subject('Confirme su registro en Cubamodela')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
        }
        return $this->render('user/createUser.html.twig', [
            'form_user' => $form_user->createView(),
            'rols' => $rols
        ]);
    }

   
    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_verify');
    }
}
