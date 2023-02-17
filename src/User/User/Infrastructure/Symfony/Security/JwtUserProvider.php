<?php

declare(strict_types=1);

namespace App\User\User\Infrastructure\Symfony\Security;

use App\User\User\Application\Query\FindUser\FindUserHandler;
use App\User\User\Application\Query\FindUser\FindUserQuery;
use App\User\User\Domain\Exception\UserDoesNotExist;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final readonly class JwtUserProvider implements UserProviderInterface
{
    public function __construct(private FindUserHandler $findUserHandler) {
    }

    public function loadUserByIdentifier(string $identifier): JwtUser
    {
        return $this->loadUser($identifier);
    }

    public function loadUserByUsername(string $username): JwtUser
    {
        return $this->loadUserByIdentifier($username);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return $class === JwtUser::class;
    }

    public function loadUser(string $identifier): JwtUser
    {
        try {
            $user = ($this->findUserHandler)(new FindUserQuery($identifier));
            return new JwtUser(
                $user->id(),
                $user->email(),
                $user->password()
            );
        } catch (UserDoesNotExist $exception) {
            throw new UserNotFoundException($identifier);
        }
    }
}