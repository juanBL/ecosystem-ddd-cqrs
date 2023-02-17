<?php

declare(strict_types=1);

namespace App\User\User\Infrastructure\Persistence\InMemory;

use App\User\User\Domain\Exception\UserDoesNotExist;
use App\User\User\Domain\Repository\UserRepository;
use App\User\User\Domain\User;
use App\User\User\Domain\ValueObject\Email;
use App\User\User\Domain\ValueObject\Password;
use App\User\User\Domain\ValueObject\UserId;

final class InMemoryUserRepository implements UserRepository
{
    private array $users;

    public function __construct()
    {
        $this->users = [
            'admin@admin.com' => User::create(
                new UserId('e7cb0c33-06ae-440f-8790-e2341dcfcf9a'),
                new Email('admin@admin.com'),
                new Password('$2y$13$nBABRTOBrsAiq4q.7qBv8.ZkEHdBpt.X62OHSFhogQh2gtWqyIy3W')
            )
        ];
    }

    public function find(Email $email): User
    {
        if (!array_key_exists($email->value(), $this->users)) {
            throw new UserDoesNotExist($email->value());
        }

        return $this->users[$email->value()];
    }
}