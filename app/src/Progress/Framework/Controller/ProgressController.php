<?php

declare(strict_types=1);

namespace Progress\Framework\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgressController extends AbstractController
{
    #[Route('/progress', name: 'GET-ALL-PROGRESS', methods: ['GET'])]
    public function getProgress(): Response
    {
        return new Response();
    }

    #[Route('/progress', name: 'GET-PROGRESS-FOR-ACTUAL-MONTH', methods: ['GET'])]
    public function getProgressForMonth(): Response
    {
        return new Response();
    }

    #[Route('/progress/activity/{activity}', name: 'GET-PROGRESS-FOR-ACTUAL-MONTH', methods: ['PUT'])]
    public function updateStatusForActivity(): Response
    {
        return new Response();
    }
}