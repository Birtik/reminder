<?php

declare(strict_types=1);

namespace Tests\Progress\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\Progress\Utils\KernelBrowserHttpClientTrait;

abstract class ProgressBaseTestCase extends WebTestCase
{
    use KernelBrowserHttpClientTrait;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpHttpClient();
    }
}
