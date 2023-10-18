<?php

declare(strict_types=1);

namespace App\Action\Command\User;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\User\Port\Command\RegisterUserInterface;
use Domain\User\Request\RegisterUserRequest;

final readonly class RegisterUserHandler implements CommandHandlerInterface
{
    public function __construct(private RegisterUserInterface $registerUser){}
    public function __invoke(RegisterUserCommand $registerUserCommand): void
    {
        $registerUserRequest = new RegisterUserRequest(
            $registerUserCommand->getFirstName(),
            $registerUserCommand->getLastName(),
            $registerUserCommand->getEmail(),
            $registerUserCommand->getPassword(),
            $registerUserCommand->getBirthDate(),
        );

        $this->registerUser->execute($registerUserRequest);
    }
}