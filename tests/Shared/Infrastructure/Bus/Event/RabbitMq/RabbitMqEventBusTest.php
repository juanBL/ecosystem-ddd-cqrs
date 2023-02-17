<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Bus\Event\RabbitMq;

use App\Apps\Api\Backend\ApiBackendKernel;
use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Infrastructure\Bus\Event\DomainEventJsonDeserializer;
use App\Shared\Infrastructure\Bus\Event\MySql\MySqlDoctrineEventBus;
use App\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqConfigurer;
use App\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqConnection;
use App\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqDomainEventsConsumer;
use App\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqEventBus;
use App\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqQueueNameFormatter;
use App\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;
use RuntimeException;
use Throwable;

final class RabbitMqEventBusTest extends InfrastructureTestCase
{
    private TestAllWorksOnRabbitMqEventsPublished $fakeSubscriber;

    protected function setUp(): void
    {
        parent::setUp();

        $connection = $this->service(RabbitMqConnection::class);

        $this->fakeSubscriber          = new TestAllWorksOnRabbitMqEventsPublished();

        $this->cleanEnvironment($connection);
    }

    protected function kernelClass(): string
    {
        return ApiBackendKernel::class;
    }

    private function cleanEnvironment(RabbitMqConnection $connection): void
    {
        $connection->queue(RabbitMqQueueNameFormatter::format($this->fakeSubscriber))->delete();
        $connection->queue(RabbitMqQueueNameFormatter::formatRetry($this->fakeSubscriber))->delete();
        $connection->queue(RabbitMqQueueNameFormatter::formatDeadLetter($this->fakeSubscriber))->delete();
    }
}
