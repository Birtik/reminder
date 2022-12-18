<?php

declare(strict_types=1);

namespace Progress\Framework\Controller;

use GuzzleHttp\Psr7\Stream;
use Progress\Application\Service\FilesStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends AbstractController
{
    #[Route('/files', name: 'GET_S3_FILE', methods: ['GET'])]
    public function getS3Files(FilesStorage $filesStorage): Response
    {
        /** @var Stream $fileBody */
        $fileBody = ($filesStorage->get('testX2.txt'))['Body'];

        return new JsonResponse(['fileContent' => $fileBody->getContents()]);
    }
}