<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

use App\Mapper\MessagesMapper;

class UserController extends Controller {

  public function __construct() {
    $this->messagesMapper = new MessagesMapper();
  }
  /**
   * @Route("/", name="homepage")
   */
  public function homepage(AuthorizationCheckerInterface $authChecker) {
    if (true === $authChecker->isGranted('ROLE_USER')){
      return $this->redirectToRoute('inbox');
    } 

    $number = mt_rand(0, 100);

    return new Response(
      '<html><body>Lucky Number: '.$number.'</body></html>'
    );
  }

  /**
   * @Route("/inbox", name="inbox")
   */

  public function inbox(Request $request) {
    if ($request->getMethod() == 'POST') {
      $data = $request->request->all();
      $this->messagesMapper->send($data);
    }
    $username = $this->getUser()->getUsername();
    return $this->render('admin/inbox.html.twig', $this->messagesMapper->messages($username));
  }

  /**
   * @Route("/inbox/{id}", name="read")
   */
  public function read($id) {
    $this->messagesMapper->read($id);
    $username = $this->getUser()->getUsername();
    $messages = $this->messagesMapper->messages($username);
    return $this->render('admin/read.html.twig', ['message' => $this->messagesMapper->message($id), 'inbox' => $messages['inbox']]);
  }

  /**
   * @Route("/compose/{id}", name="compose")
   */
  public function compose($id, Request $request) {
    $user = $this->messagesMapper->user($id);
    $to = $user['prenom'].' '.$user['nom'];
    $username = $this->getUser()->getUsername();
    $messages = $this->messagesMapper->messages($username);
    $from = $this->messagesMapper->username($username)['id'];
    return $this->render('admin/compose.html.twig', ['inbox' => $messages['inbox'], 'to' => $to, 'id' => $id, 'from' => $from]);
  }

}
