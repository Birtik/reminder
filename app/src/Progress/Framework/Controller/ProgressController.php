<?php

declare(strict_types=1);

namespace Progress\Framework\Controller;

use Progress\Application\Command\UpdateStatusActivity;
use Progress\Domain\Day;
use Progress\Domain\Repository\DayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProgressController extends AbstractController
{

    public function __construct(
        private DayRepository $repository,
        private MessageBusInterface $progressCommandBus,
    ) {
    }


    #[Route('/progress', name: 'GET_ALL_PROGRESS', methods: ['GET'])]
    public function getProgress(): Response
    {

        dump($this->repository);

//        $te = $repository->findOneBy(1);
//
//        dump($te);

        return new Response();
    }

    #[Route('/progress', name: 'GET_PROGRESS_FOR_ACTUAL_MONTH', methods: ['GET'])]
    public function getProgressForMonth(): Response
    {
        return new Response();
    }

    #[Route('/progress/activity/{activity}', name: 'UPDATE_STATUS_FOR_ACTIVITY', methods: ['GET'])]
    public function updateStatusForActivity(int $activity): Response
    {
        $this->progressCommandBus->dispatch(new UpdateStatusActivity($activity));

        return new Response();
    }
}