<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Mapper\AdminMapper;
use App\Mapper\FormationMapper;
use App\Mapper\InscriptionMapper;

class LoginController extends Controller {
  
  /**
   * @Route("/login")
   */
  public function login() {
    return $this->render('login.html.twig');
  }

  /**
   * @Route("/register")
   */
  public function register() {
    return $this->render('register.html.twig');
  }
}

