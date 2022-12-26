<?php

declare(strict_types=1);

namespace Progress\Framework\Controller;

use Progress\Application\Command\UpdateStatusActivity;
use Progress\Application\Query\GetAllDaysQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProgressController extends AbstractController
{
    public function __construct(
        private MessageBusInterface $progressCommandBus,
        private GetAllDaysQuery $allDaysQuery,
    ) {
    }

    #[Route('/api/progress', name: 'GET_ALL_PROGRESS', methods: ['GET'])]
    public function getProgress(): Response
    {
        return new JsonResponse(($this->allDaysQuery)());
    }

    #[Route('/api/progress/activity/{activity}', name: 'UPDATE_STATUS_FOR_ACTIVITY', methods: ['PUT'])]
    public function updateStatusForActivity(int $activity): Response
    {
        $this->progressCommandBus->dispatch(new UpdateStatusActivity($activity));

        return new Response(status: 204);
    }
}