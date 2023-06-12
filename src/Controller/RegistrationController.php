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

use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class RegistrationController extends AbstractController
{
    private $keyController;
    private $rolsRepository;
    private $verifyEmailHelper;
    private $mailer;
    private $userRepository;
    public function __construct(UserRepository $userRepository, KeyController $keyController, RolsRepository $rolsRepository, VerifyEmailHelperInterface $helper)
    {
        $this->keyController = $keyController;
        $this->rolsRepository = $rolsRepository;
        $this->verifyEmailHelper = $helper;
       
        $this->userRepository = $userRepository;
    }



    #[Route('/register', name: 'app_register')]
    public function register(MailerInterface $mailer/*Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthenticator $authenticator, EntityManagerInterface $entityManager*/): Response
    {
        // $user = new User();
        // $form_user = $this->createForm(UserType::class, $user);
        // $form_user->handleRequest($request);
        // $rols= $this->rolsRepository->findAll();
        // if ($form_user->isSubmitted() && $form_user->isValid()) {
        //     // encode the plain password
        //     $user->setPassword(
        //         $userPasswordHasher->hashPassword(
        //             $user, 
        //             $form_user->get('password')->getData()
        //         )
        //     );
        //     $entityManager->persist($user);
        //     $entityManager->flush();
        //     $idUser= $this->userRepository->findOneBy(['email'=>$user->getEmail()])->getId();
        //    $signatureComponents = $this->verifyEmailHelper->generateSignature(
        //     'registration_confirmation_route',
        //     $idUser,
        //     $user->getEmail()
        // );
        // $email = (new Email())
        //     ->from('informacion@cubamodela.com')
        //     ->to('risolution9206@gmail.com')
        //     ->subject('Email Test')
        //     ->text('A sample email using mailtrap.');

        // $this->mailer->send($email);
        // return new Response(
        //     'Email sent successfully'
        // );

        $email = (new Email())
       // ->from('proveedor@cubamodela.com')
       ->from('proveedor@cubamodela.com')
        ->to('risolution9206@gmail.com')
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject('Time for Symfony Mailer!')
        ->text('Sending emails is fun again!');
        

    $mailer->send($email);

        // $mailer->send($email);
        // $email = new TemplatedEmail();
        // $email->from('informacion@cubamodela.com');
        // $email->to('risolution9206@gmail.com');
        // $email->subject('Time for Symfony Mailer!');
        // $email->text('Sending emails is fun again!');
        // $email->html('<p>See Twig integration for better HTML integration!</p>');




        // // $email->htmlTemplate('registration/confirmation_email.html.twig');
        // // $email->context(['signedUrl' => $signatureComponents->getSignedUrl()]);

        // $this->mailer->send($email);


        // do anything else you need here, like send an email

        // return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        // }

        // return $this->render('user/createUser.html.twig', [
        //     'form_user' => $form_user->createView(),
        //     'rols'=>$rols        

 return new Response(
            'Email sent successfully'
        );
    }

    /**
     * @Route("/verify", name="registration_confirmation_route")
     */
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        // Do not get the User's Id or Email Address from the Request object
        try {
            $this->verifyEmailHelper->validateEmailConfirmation($request->getUri(), $user->getId(), $user->getEmail());
        } catch (VerifyEmailExceptionInterface $e) {
            $this->addFlash('verify_email_error', $e->getReason());

            return $this->redirectToRoute('app_register');
        }

        // Mark your user as verified. e.g. switch a User::verified property to true

        $this->addFlash('success', 'Your e-mail address has been verified.');

        return $this->redirectToRoute('app_home');
    }
}
