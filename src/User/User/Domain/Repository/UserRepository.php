<?php

declare(strict_types=1);

namespace App\User\User\Domain\Repository;

use App\User\User\Domain\Exception\UserDoesNotExist;
use App\User\User\Domain\User;
use App\User\User\Domain\ValueObject\Email;

interface UserRepository
{
    /** @throws UserDoesNotExist */
    public function find(Email $email): User;
}