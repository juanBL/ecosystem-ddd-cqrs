<?php

declare(strict_types=1);

namespace App\User\User\Application\Query\FindUser;

use App\Shared\Domain\Bus\Query\QueryHandler;
use App\User\User\Domain\Service\UserFinder;
use App\User\User\Domain\ValueObject\Email;

final readonly class FindUserHandler implements QueryHandler
{
    public function __construct(private UserFinder $finder)
    {
    }

    public function __invoke(FindUserQuery $query): FindUserResponse
    {
        $email = new Email($query->email());
        $user = $this->finder->find($email);

        return new FindUserResponse(
            $user->id()->value(),
            $user->email()->value(),
            $user->password()->value()
        );
    }
}
