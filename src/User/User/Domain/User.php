<?php

declare(strict_types=1);

namespace App\User\User\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;
use App\User\User\Domain\ValueObject\Email;
use App\User\User\Domain\ValueObject\Password;
use App\User\User\Domain\ValueObject\UserId;

final class User extends AggregateRoot
{
    public function __construct(
        private readonly UserId $id,
        private readonly Email $email,
        private readonly Password $password
    ) {
    }

    public static function create(
        UserId $id,
        Email $email,
        Password $password
    ): self {
        return new self($id, $email, $password);
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): Password
    {
        return $this->password;
    }
}