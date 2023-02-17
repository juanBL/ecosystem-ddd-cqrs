<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Bus\Event\RabbitMq;

use App\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class TestAllWorksOnRabbitMqEventsPublished implements DomainEventSubscriber
{
    public static function subscribedTo(): array
    {
        return [];
    }
}
