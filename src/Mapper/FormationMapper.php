<?php

namespace App\Mapper;
use GuzzleHttp\Client;

class FormationMapper {

  private $client;

  public function __construct() {
    $this->client = new Client(['base_uri' => 'localhost:8080/']);
  }

  private function postFormation($data) {
    $response = $this->client->request('POST', '/formations', ['json' => $data]);
    $body = $response->getBody();
  }

  private function getFormations() {
    $response = $this->client->get('/formations');
    return $response->getBody();
  }

  private function getFormation($id) {
    $response = $this->client->get('/formations/'.$id);
    return $response->getBody();
  }

  public function formation($id) {
    $formation = json_decode($this->getFormation($id));
    return $formation;
  }

  public function accepter($id) {
    $response = $this->client->request('POST', '/admin/formation', ['json' => ['id' => $id]]);
    return $response->getBody();
  }

  public function formations() {
    $formations = json_decode($this->getFormations(), TRUE);

    $results = array_map(function ($formation) {
      $formation['date'] = date('j F H:i', strtotime($formation['date']));
      $formation['status'] = $formation['confirme'] ? 'OUI' : 'NON';
      return $formation;
    }, $formations);

    return $results;
  }

  public function handlePostFormation($data) {
    $data['date'] = $data['date'].'T'.$data['time'];
    $this->postFormation($data);
  }
}
