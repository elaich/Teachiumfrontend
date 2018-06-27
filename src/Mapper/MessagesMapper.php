<?php

namespace App\Mapper;
use GuzzleHttp\Client;

class MessagesMapper {

  private $client;

  public function __construct() {
    $this->client = new Client(['base_uri' => 'localhost:8080/']);
  }

  private function getMessages($username) {
    $response = $this->client->get('/admin/messages?username='.$username);
    return $response->getBody();
  }

  private function getUser($id) {
    $response = $this->client->get('/utilisateur/'.$id);
    return $response->getBody();
  }

  public function user($id) {
    return json_decode($this->getUser($id), TRUE);
  }

  public function username($username) {
    $response = $this->client->get('/admin/users/'.$username);
    $user = json_decode($response->getBody(), TRUE);
    return $user;
  }
  
  private function getMessage($id) {
    $response = $this->client->get('/admin/messages/'.$id);
    return $response->getBody();
  }

  public function read($id) {
    $response = $this->client->get('/admin/messages/read/'.$id);
  }

  public function send($message) {
    $this->client->request('POST', '/utilisateur/contact', ['json' => $message]);
  }

  public function message($id) {
    $message = json_decode($this->getMessage($id), TRUE);
    $user = json_decode($this->getUser($message["from"]), TRUE);
    $message['from'] = $user['nom'].' '.$user['prenom'];
    $message['date'] = date('M t H:m', strtotime($message['date']));
    return $message;
  }

  private function registerUser($user) {
    $this->client->request('POST', '/utilisateur', ['json' => $user]);
  }

  public function register($data) {
    $this->registerUser($data);
  }

  public function messages($username) {
    $messages = json_decode($this->getMessages($username), TRUE);
    $mapper = $this;
    $messages = array_map(function ($message) use ($mapper) {
      $user = json_decode($mapper->getUser($message["from"]), true);
      $message['from'] = $user['nom'].' '.$user['prenom'];
      $message['date'] = date('M t', strtotime($message['date']));
      return $message;
    }, $messages);

    $inbox = 0;
    foreach ($messages as $message) {
      if ($message['read'] === false) {
        $inbox++;
      }
    }

    return ['inbox' => $inbox, 'messages' => $messages];
  }
}

