<?php

declare(strict_types=1);

namespace App\User\User\Application\Query\FindUser;

use App\Shared\Domain\Bus\Query\Query;

final readonly class FindUserQuery implements Query
{
    public function __construct(private string $email)
    {
    }

    public function email(): string
    {
        return $this->email;
    }
}
