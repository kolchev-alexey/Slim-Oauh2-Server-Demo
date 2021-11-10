<?php

declare(strict_types=1);

namespace Api\Http\Action\Auth\SignUp;

use Api\Http\Request\ConfirmRequest;
use Api\Http\ValidationException;
use Api\Http\Validator\Validator;
use Api\Model\Flusher;
use Api\Model\User\Entity\User\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class ConfirmAction implements RequestHandlerInterface
{
    private $validator;
    private $users;
    private $flusher;

    public function __construct(Validator $validator, UserRepository $users, Flusher $flusher)
    {
        $this->validator = $validator;
        $this->users = $users;
        $this->flusher = $flusher;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $command = new ConfirmRequest($request->getParsedBody());

        if ($errors = $this->validator->validate($command)) {
            throw new ValidationException($errors);
        }

        $user = $this->users->getByEmail($command->email);

        $user->confirmSignup($command->token, new \DateTimeImmutable());

        $this->flusher->flush($user);

        return new JsonResponse([]);
    }

}
