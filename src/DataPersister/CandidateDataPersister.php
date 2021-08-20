<?php

namespace App\DataPersister;

use App\Entity\Candidate;

final class CandidateDataPersister extends UserDataPersister
{
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Candidate;
    }

    public function persist($data, array $context = [])
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();

        $user = $this->createUser($data, ['ROLE_CANDIDATE']);
        $user->setProfileId($data->getId());
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        
        return $data;
    }

    public function remove($data, array $context = [])
    {
      // call your persistence layer to delete $data
    }
}