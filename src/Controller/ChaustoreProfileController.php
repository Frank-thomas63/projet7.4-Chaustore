<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\ChaustoreProfileController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ChaustoreProfileController extends AbstractController
{
    /**
   * @var ProductRepository
   * @var StockRepository
   * @var UserRepository
   */
  private $repository;

  /**
   * @var ObjectManager
   */
   private $em;


  public function __construct( ProductRepository $repository, UserRepository $UserRepository, ObjectManager $em)
  {
      $this->UserRepository = $UserRepository;
      $this->repository = $repository;
      $this->em = $em;
  }


// to display the data >  pour afficher les données
  /**
   * @Route("/profile", name="chaustore.profile")
   * @return \Symfony\Component\HttpFoundation\Response
   */

  public function index(): Response
  {
     $users = $this->UserRepository->findAll();
     $products = $this->repository->findAll();
      
     return $this->render('profile/index.html.twig', ['products' => $products, 'users'=> $users]);
  }
  public function show($id)
  {
    $user = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findOneByIdJoinedToUserName($id);

    $user = $user->getUser();
  }
    
}
 


