<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Tests\Shared\Infrastructure\Mockery\MatcherIsSimilar;
use App\Tests\Shared\Infrastructure\PhpUnit\Constraint\ConstraintIsSimilar;

final class TestUtils
{
    public static function isSimilar(AggregateRoot|DomainEvent $expected, AggregateRoot|DomainEvent $actual): bool
    {
        $constraint = new ConstraintIsSimilar($expected);

        return $constraint->evaluate($actual, '', true);
    }

    public static function assertSimilar($expected, $actual): void
    {
        $constraint = new ConstraintIsSimilar($expected);

        $constraint->evaluate($actual);
    }

    public static function similarTo(DomainEvent $value, $delta = 0.0): MatcherIsSimilar
    {
        return new MatcherIsSimilar($value, $delta);
    }
}
