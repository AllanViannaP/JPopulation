<?php

namespace App\Repositories;

use App\Entities\PopulationData;
use Doctrine\ORM\EntityManagerInterface;

class PopulationDataRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(PopulationData $populationData): void
    {
        $this->entityManager->persist($populationData);
        $this->entityManager->flush();
    }
}
