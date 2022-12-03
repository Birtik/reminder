<?php

declare(strict_types=1);

namespace Account\Framework\Controller;

use SharedKernel\Application\Aws\DynamoDb\KeyValueDatabaseClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    public function __construct(
        private KeyValueDatabaseClient $trainingCompletedDb
    ) {
    }

    #[Route('/index', name: 'INDEX', methods: ['GET'])]
    public function index(): Response
    {
        return new Response();
    }
}