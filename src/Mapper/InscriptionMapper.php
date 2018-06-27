<?php

namespace App\Mapper;
use GuzzleHttp\Client;

class InscriptionMapper {

  private $client;

  public function __construct() {
    $this->client = new Client(['base_uri' => 'localhost:8080/']);
  }

  private function getInscriptions() {
    $response = $this->client->get('/admin/inscriptions');
    return $response->getBody();
  }

  public function refuser($id) {
    $response = $this->client->request('POST', '/admin/utilisateur/refuser', ['json' => ['id' => $id]]);
    return $response->getBody();
  }

  public function accepter($id) {
    $response = $this->client->request('POST', '/admin/utilisateur', ['json' => ['id' => $id]]);
    return $response->getBody();
  }

  public function inscriptions() {
    $inscriptions = json_decode($this->getInscriptions(), TRUE);

    return array_map(function($inscription) {
      $inscription['utilisateur'] = $inscription['prenom'].' '.$inscription['nom'];
      return $inscription;
    }, $inscriptions);
  }
}

