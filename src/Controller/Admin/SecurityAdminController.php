<?php

namespace App\Controller\Admin;


use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityAdminController extends AbstractController
{
      /**
      * @Route("/admin/registrationAdmin", name="admin.registrationAdmin")
      */
    
      public function registrationAdmin(Request $request, ObjectManager $manager)
      {
            $user = new User();
            $user->setRoles(['ROLE_ADMIN']);
            $form = $this->createForm(RegistrationType::class, $user);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                
                $manager->persist($user);
                $manager->flush();
            }
                 return $this->render('admin/registrationAdmin.html.twig', [
                'form' => $form->createView()
            ]);
      }

}
