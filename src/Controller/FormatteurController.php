<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Mapper\FormationMapper;

class FormatteurController extends Controller {
  private $formationMapper;

  public function __construct() {
    $this->formationMapper = new FormationMapper();
  }

  /**
   * @Route("/formations/new")
   */
  public function addFormation() {
    return $this->render('formatteur/new.html.twig');
  }

  /**
   * @Route("/formations/success")
   */
  public function submitFormation(Request $request) {
    $data = $request->request->all();
    $this->formationMapper->handlePostFormation($data);

    return new Response(
      '<html><body>Form Submitted Successfully</body></html>'
    );
  }

}

