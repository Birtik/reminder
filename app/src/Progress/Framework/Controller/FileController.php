<?php

declare(strict_types=1);

namespace Progress\Framework\Controller;

use Progress\Application\Service\FilesStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends AbstractController
{
    #[Route('/files', name: 'GET_S3_FILES', methods: ['GET'])]
    public function getS3Files(FilesStorage $filesStorage): Response
    {
        $filesStorage->get('test.txt');

        return new Response();
    }

    #[Route('/files/upload', name: 'UPLOAD_S3_FILES', methods: ['GET'])]
    public function uploadS3Files(FilesStorage $filesStorage): Response
    {
        $filesStorage->upload('file.txt');

        return new Response();
    }
}