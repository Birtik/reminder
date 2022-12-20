<?php

declare(strict_types=1);

namespace Progress\Infrastructure\Doctrine\Repository;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Exception;
use Progress\Domain\Day;
use Progress\Domain\Repository\DayRepository;

final class DoctrineDayRepository implements DayRepository
{
    private EntityRepository $repository;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Day::class);
    }

    public function getAllDays(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @throws Exception
     */
    public function findOneByActivity(int $id): Day
    {
        $date = new DateTime('now');
        $from = new DateTime($date->format("Y-m-d")." 00:00:00");
        $to   = new DateTime($date->format("Y-m-d")." 23:59:59");

        $qb = $this->repository->createQueryBuilder("d");
        $qb
            ->where('d.activity = :id')
            ->andWhere('d.date BETWEEN :from AND :to')
            ->setParameter('id', $id)
            ->setParameter('from', $from)
            ->setParameter('to', $to);

        return $qb->getQuery()->getSingleResult();
    }

    public function update(Day $day): void
    {
        $day->markAsComplete();
    }
}