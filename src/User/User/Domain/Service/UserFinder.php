<?php

declare(strict_types=1);

namespace App\User\User\Domain\Service;

use App\User\User\Domain\Repository\UserRepository;
use App\User\User\Domain\User;
use App\User\User\Domain\ValueObject\Email;

final class UserFinder
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function find(Email $email): User
    {
        return $this->repository->find($email);
    }
}