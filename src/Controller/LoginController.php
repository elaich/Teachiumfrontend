<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Mapper\MessagesMapper;

class LoginController extends Controller {
  
  public function __construct() {
    $this->messagesMapper = new MessagesMapper();
  }
  /**
   * @Route("/login", name="login")
   */
  public function login(Request $request, AuthenticationUtils $authenticationUtils) {
    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('login.html.twig', [
      'last_username' => $lastUsername
    ]);
  }

  /**
   * @Route("/register", name="register")
   */
  public function register(Request $request) {
    if ($request->getMethod() == 'POST') {
      $this->messagesMapper->register($request->request->all());
      return $this->redirectToRoute('login');
    }
    return $this->render('register.html.twig');
  }
}

