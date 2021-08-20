<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

abstract class UserDataPersister implements ContextAwareDataPersisterInterface
{
    private $encoder;
    protected $entityManager;

    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager)
    {
        $this->encoder = $encoder;
        $this->entityManager = $entityManager;
    }

    protected function createUser($data, array $roles): User
    {
        $user = new User();
        $user->setEmail($data->getEmail());
        $user->setPassword($this->encoder->encodePassword($user, $data->getPassword()));
        $user->setRoles($roles);
        return $user;
    }
}