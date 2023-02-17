<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBus;
use Symfony\Component\HttpFoundation\RequestStack;

final readonly class SymfonyRequestInjectorEventBusDecorator implements EventBus
{
    public function __construct(private EventBus $eventBus, private RequestStack $requestStack)
    {
    }

    public function publish(DomainEvent ...$events): void
    {
        $this->eventBus->publish(...$events);
        $this->requestStack->getMainRequest()->attributes->set('_domain_events', $events);
        $this->requestStack->getMainRequest()->attributes->set('_event_bus', $this->eventBus::class);
    }
}