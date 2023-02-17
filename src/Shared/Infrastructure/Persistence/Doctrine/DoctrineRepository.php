<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine;

use App\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

abstract class DoctrineRepository
{
    protected ObjectManager $em;

    public function __construct(ManagerRegistry $registry)
    {
        $this->em = $registry->getManagerForClass($this->aggregateRootFQCN());
    }

    abstract public function aggregateRootFQCN(): string;


    protected function entityManager(): EntityManager
    {
        return $this->em;
    }

    protected function persist(AggregateRoot $entity): void
    {
        $this->entityManager()->persist($entity);
        $this->entityManager()->flush($entity);
    }

    protected function remove(AggregateRoot $entity): void
    {
        $this->entityManager()->remove($entity);
        $this->entityManager()->flush($entity);
    }

    protected function repository(): ObjectRepository
    {
        return $this->em->getRepository($this->aggregateRootFQCN());
    }
}
