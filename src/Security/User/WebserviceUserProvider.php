<?php

// src/Security/User/WebserviceUserProvider.php
namespace App\Security\User;

use App\Security\User\WebserviceUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

use App\Mapper\UserMapper;

class WebserviceUserProvider implements UserProviderInterface
{
  public function loadUserByUsername($username)
  {
    $userMapper = new UserMapper();
    // make a call to your webservice here
    $userData = $userMapper->getUserByEmail($username);
      // pretend it returns an array on success, false if there is no user

      if ($userData) {
        $password = $userData['password'];
        $roles = $userData['roles'];
        $salt = $userData['salt'];
        return new WebserviceUser($username, $password, $salt, $roles);
      }

    throw new UsernameNotFoundException(
      sprintf('Username "%s" does not exist.', $username)
    );
  }

  public function refreshUser(UserInterface $user)
  {
    if (!$user instanceof WebserviceUser) {
      throw new UnsupportedUserException(
        sprintf('Instances of "%s" are not supported.', get_class($user))
      );
    }

    return $this->loadUserByUsername($user->getUsername());
  }

  public function supportsClass($class)
  {
    return WebserviceUser::class === $class;
  }
}
