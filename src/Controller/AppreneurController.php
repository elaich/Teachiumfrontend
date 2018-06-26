<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Mapper\AdminMapper;
use App\Mapper\FormationMapper;
use App\Mapper\InscriptionMapper;

class AppreneurController extends Controller {

   /**
   * @Route("/appreneur_formations/{id}", name="appreneur_formation")
   */
  public function formation() {
    return $this->render('appreneur/formation.html.twig', [
        'formation' => ['id' => 2, 'name' => 'Une Autre Formation', 'date' => '13 January 2018', 'salle' => '11', 'inscrit' => 'Oui', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id felis magna. Mauris dictum mauris felis, aliquet vehicula sem bibendum nec. Mauris at tempus mi, nec fermentum orci. Mauris vulputate pulvinar ornare. Sed at turpis sagittis, aliquet velit eget, scelerisque libero.', 'ajoute' => true],
    ]);
  }

  /**
   * @Route("/appreneur_messages", name="appreneur_messages")
   */
  public function messages() {
    return $this->render('appreneur/messages.html.twig', [
      'messages' => [
        ['de' => 'Admin F', 'objet' => 'Un Objet', 'text' => 'Nunc malesuada metus et felis sollicitudin pretium. Donec non viverra nisl. Curabitur congue iaculis ultrices. Ut semper non velit nec commodo. Etiam luctus felis nisl, vitae dapibus ante feugiat eget. Donec mattis lacinia interdum. Praesent fermentum imperdiet arcu vel scelerisque.']
      ]
    ]);
  }
   
  /**
   * @Route("/appreneur_formations", name="appreneur_formations")
   */
  public function formations() {
    return $this->render('appreneur/formations.html.twig', [
      'formations' => [
        ['id' => 1, 'name' => 'Juste Une Formation', 'date' => '23 January 2018', 'salle' => '13', 'inscrit' => 'Oui', 'description' => ' Nullam in augue id massa rhoncus sodales. Sed elit odio, dictum a tincidunt a, tristique porta dolor. Nunc nec sollicitudin sem. Nunc bibendum tellus non mollis tincidunt. Donec vel quam ut neque condimentum fermentum. Nullam tincidunt mi vitae dictum scelerisque. Nulla vitae auctor elit, eu feugiat est.'],
        ['id' => 2, 'name' => 'Une Autre Formation', 'date' => '13 January 2018', 'salle' => '11', 'inscrit' => 'Oui', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id felis magna. Mauris dictum mauris felis, aliquet vehicula sem bibendum nec. Mauris at tempus mi, nec fermentum orci. Mauris vulputate pulvinar ornare. Sed at turpis sagittis, aliquet velit eget, scelerisque libero.'],
        ['id' => 3, 'name' => 'Une Formation Etrange', 'date' => '23 February 2018', 'salle' => '12', 'inscrit' => 'Non', 'description' => 'Cras elementum mauris erat, sed consectetur nisl congue eleifend. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris nec cursus sapien, vel molestie erat. Nullam a venenatis nisl. Nullam placerat erat commodo lobortis pharetra. Donec porttitor volutpat neque, eu sodales nulla tempor vitae. Maecenas sem orci, tempor et libero vitae, elementum sodales metus. Pellentesque sit amet justo elementum, accumsan quam in, rhoncus nisi. '],
      ]
    ]);
  }
}


