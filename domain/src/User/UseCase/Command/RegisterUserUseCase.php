<?php

declare(strict_types=1);

namespace Domain\User\UseCase\Command;

use Domain\User\Domain\Enum\UserRoleEnum;
use Domain\User\Domain\Exception\EmailException;
use Domain\User\Domain\Exception\UserRoleException;
use Domain\User\Domain\Model\User;
use Domain\User\Port\Command\RegisterUserInterface;
use Domain\User\Repository\Command\UserCommandRepositoryInterface;
use Domain\User\Request\RegisterUserRequest;

final readonly class RegisterUserUseCase implements RegisterUserInterface
{
    public function __construct(private UserCommandRepositoryInterface $userCommandRepository)
    {
    }

    /**
     * @throws UserRoleException
     * @throws EmailException
     */
    public function execute(RegisterUserRequest $registerUserRequest): void
    {
        $user = new User(
            'id',
            $registerUserRequest->getFirstName(),
            $registerUserRequest->getLastName(),
            $registerUserRequest->getEmail(),
            $registerUserRequest->getPassword(),
            [UserRoleEnum::USER->value],
            $registerUserRequest->getBirthDate()
        );

        $this->userCommandRepository->register($user);
    }
}