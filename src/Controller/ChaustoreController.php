<?php

namespace App\Controller;


use App\Entity\Product;
use App\Entity\User;
use App\Form\ProductType;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\AdminProductController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ChaustoreController extends AbstractController
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
   * @Route("/", name="chaustore")
   * @return \Symfony\Component\HttpFoundation\Response
   */

  public function index(): Response
  {
     $user= $this->UserRepository->findAll();
     $products = $this->repository->findAll();

     return $this->render('chaustore/index.html.twig', ['products' => $products, 'user'=> $user]);
  }

 

}
