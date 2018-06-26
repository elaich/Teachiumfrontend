<?php

namespace App\Mapper;
use GuzzleHttp\Client;

class AdminMapper {

  private $client;

  public function __construct() {
    $this->client = new Client(['base_uri' => 'localhost:8080/']);
  }

  private function getMessages() {
    $response = $this->client->get('/admin/messages');
    return $response->getBody();
  }

  private function getMessage($id) {
    $response = $this->client->get('/admin/messages/'.$id);
    return $response->getBody();
  }

  private function getUser($id) {
    $response = $this->client->get('/utilisateur/'.$id);
    return $response->getBody();
  }

  public function message($id) {
    $message = json_decode($this->getMessage($id), TRUE);
    $user = json_decode($this->getUser($message["from"]), TRUE);
    $message['from'] = $user['nom'].' '.$user['prenom'];
    return $message;
  }


  public function messages() {
    $messages = json_decode($this->getMessages(), TRUE);
    $mapper = $this;
    return array_map(function ($message) use ($mapper) {
      $user = json_decode($mapper->getUser($message["from"]), true);
      $message['from'] = $user['nom'].' '.$user['prenom'];
      return $message;
    }, $messages);
  }
}
