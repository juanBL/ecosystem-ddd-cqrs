<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Bus\Event\MySql;

use App\Apps\Api\Backend\ApiBackendKernel;
use App\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;

final class MySqlDoctrineEventBusTest extends InfrastructureTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function kernelClass(): string
    {
        return ApiBackendKernel::class;
    }
}
