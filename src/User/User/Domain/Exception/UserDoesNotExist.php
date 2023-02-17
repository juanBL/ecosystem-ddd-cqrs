<?php

declare(strict_types=1);

namespace App\User\User\Domain\Exception;

use RuntimeException;

final class UserDoesNotExist extends RuntimeException
{
    public function __construct(string $email)
    {
        parent::__construct("User with email '$email' does not exist");
    }
}