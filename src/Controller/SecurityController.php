<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
      /**
      * @Route("/registration", name="security.registration")
      */
    
      public function registration(Request $request, ObjectManager $manager)
      {
            $user = new User();
            $user->setRoles(['ROLE_USER']);
            $form = $this->createForm(RegistrationType::class, $user);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                
                $manager->persist($user);
                $manager->flush();
            }
            return $this->render('security/registration.html.twig', [
                'form' => $form->createView()
            ]);
      }

}
