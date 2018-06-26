<?php

namespace App\Mapper;
use GuzzleHttp\Client;

class InscriptionMapper {

  private $client;

  public function __construct() {
    $this->client = new Client(['base_uri' => 'localhost:8080/']);
  }

  public function inscriptions() {
    return [
      ['utilisateur' => 'Marouane ElAich', 'type' => 'Formatteur'],
      ['utilisateur' => 'Marouane Awesome', 'type' => 'Appreneur'],
    ];
  }
}

