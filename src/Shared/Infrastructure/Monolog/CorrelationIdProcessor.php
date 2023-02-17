<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Monolog;

use Monolog\LogRecord;
use Symfony\Component\HttpFoundation\RequestStack;

final readonly class CorrelationIdProcessor
{
    public function __construct(private RequestStack $requestStack)
    {
    }

    public function __invoke(LogRecord $logRecord): LogRecord
    {
        $request = $this->requestStack->getMainRequest();

        if (!$request->headers || !$request->headers->has('X-CID')) {
            return $logRecord;
        }
        $logRecord->offsetSet('extra', $request->headers->get('X-CID'));


        return $logRecord;
    }
}