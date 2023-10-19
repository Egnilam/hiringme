<?php

declare(strict_types=1);

namespace Domain\User\UseCase\Command;

use Domain\Common\Domain\Exception\EmailFormatException;
use Domain\Common\Domain\Exception\NameFormatException;
use Domain\Common\Domain\ValueObject\EmailValueObject;
use Domain\Common\Domain\ValueObject\NameValueObject;
use Domain\User\Domain\Enum\UserRoleEnum;
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
     * @throws NameFormatException
     * @throws EmailFormatException
     */
    public function execute(RegisterUserRequest $registerUserRequest): void
    {
        $user = new User(
            'id',
            new NameValueObject($registerUserRequest->getFirstName(), NameValueObject::PROPERTY_FIRSTNAME),
            new NameValueObject($registerUserRequest->getLastName(), NameValueObject::PROPERTY_LASTNAME),
            new EmailValueObject($registerUserRequest->getEmail()),
            $registerUserRequest->getPassword(),
            [UserRoleEnum::USER->value],
            $registerUserRequest->getBirthDate()
        );

        $this->userCommandRepository->register($user);
    }
}
