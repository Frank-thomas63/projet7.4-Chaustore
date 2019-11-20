<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
      /**
      * @Route("/registration", name="security.registration")
      */
    
      public function registration(Request $request, ObjectManager $manager, 
      UserPasswordEncoderInterface $encoder)
      {
            $user = new User();
            $user->setRoles(['ROLE_USER']);
            $form = $this->createForm(RegistrationType::class, $user);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {   
                $hash = $encoder->encodePassword($user, $user->getPassword());  
                $user->setPassword($hash);
                $manager->persist($user);
                $manager->flush();
                return $this->redirectToRoute('login');
            }
            return $this->render('security/registration.html.twig', [
                'form' => $form->createView()
            ]);
      }


       /**
      * @Route("/login", name="login")
      */

      public function login(AuthenticationUtils $authenticationUtils)
      {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig',[
            'last_username' => $lastUsername,
            'error' =>$error
        ]);
      }

}
