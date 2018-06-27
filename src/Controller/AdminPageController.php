<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Mapper\AdminMapper;
use App\Mapper\FormationMapper;
use App\Mapper\InscriptionMapper;

class AdminPageController extends Controller {
  private $adminMapper;
  private $formationMapper;
  private $inscriptionMapper;

  public function __construct() {
    $this->adminMapper = new AdminMapper();
    $this->formationMapper = new FormationMapper();
    $this->inscriptionMapper = new InscriptionMapper();
  }

  public function page() {
    $number = mt_rand(0, 100);

    return new Response(
      '<html><body>Lucky Number: '.$number.'</body></html>'
    );
  }

  /**
   * @Route("/admin_inbox", name="admin_inbox")
   */
  public function inbox() {
    return $this->render('admin/inbox.html.twig', array(
      'messages' => $this->adminMapper->messages(),
      'inbox' => 2,
    ));
  }

  /**
   * @Route("/admin_inbox/{id}")
   */
  public function read($id) {
    return $this->render('admin/read.html.twig', array(
      'message' => $this->adminMapper->message($id),
      'inbox' => 2,
    ));
  }

  /**
   * @Route("/formations", name="formations")
   */
  public function formations() {
    $formations = $this->formationMapper->formations();
    return $this->render('admin/formations.html.twig', array(
      'formations' => $formations
    ));
  }

  /**
   * @Route("/utilisateurs")
   */
  public function utilisateurs() {
    $inscriptions = $this->inscriptionMapper->inscriptions();
    return $this->render('admin/utilisateurs.html.twig', array(
      'utilisateurs' => $inscriptions
    ));
  }

  /**
   * @Route("/inscriptions", name="demandes_inscriptions")
   */
  public function inscriptions() {
    $inscriptions = $this->inscriptionMapper->inscriptions();
    return $this->render('admin/inscriptions.html.twig', array(
      'inscriptions' => $inscriptions
    ));
  }

  /**
   * @Route("/inscriptions/refuser/{id}", name="refuser_inscription")
   */
  public function refuser($id) {
    $this->inscriptionMapper->refuser($id);
    return $this->redirectToRoute("demandes_inscriptions");
  }
  /**
   * @Route("/inscriptions/accepter/{id}", name="accepter_inscription")
   */
  public function accepter($id) {
    $this->inscriptionMapper->accepter($id);
    return $this->redirectToRoute("demandes_inscriptions");
  }

  /**
   * @Route("/formations/accepter/{id}", name="accepter_formation")
   */
  public function accepterFormation($id) {
    $this->formationMapper->accepter($id);
    return $this->redirectToRoute("formations");
  }

  /**
   * @Route("/formations/{id}", name="formation")
   */
  public function formation($id) {
    $formation = $this->formationMapper->formation($id);
    return $this->render('admin/formation.html.twig', array(
      'formation' => $formation
    ));
  }
}
