<?php

declare(strict_types=1);

namespace Api\Http\Action\Auth\SignUp;

use Api\Http\Request\SignUpRequest;
use Api\Http\ValidationException;
use Api\Http\Validator\Validator;
use Api\Model\Flusher;
use Api\Model\User\Entity\User\User;
use Api\Model\User\Entity\User\UserId;
use Api\Model\User\Entity\User\UserRepository;
use Api\Model\User\Service\ConfirmTokenizer;
use Api\Model\User\Service\PasswordHasher;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class RequestAction implements RequestHandlerInterface
{
    private $validator;
    private $users;
    private $hasher;
    private $tokenizer;
    private $flusher;

    public function __construct(
        Validator $validator,
        UserRepository $users,
        PasswordHasher $hasher,
        ConfirmTokenizer $tokenizer,
        Flusher $flusher
    )
    {
        $this->validator = $validator;
        $this->users = $users;
        $this->hasher = $hasher;
        $this->tokenizer = $tokenizer;
        $this->flusher = $flusher;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $command = new SignUpRequest($request->getParsedBody());

        if ($errors = $this->validator->validate($command)) {
            throw new ValidationException($errors);
        }

        if ($this->users->hasByEmail($command->email)) {
            throw new \DomainException('User with this email already exists.');
        }

        $user = new User(
            UserId::next(),
            new \DateTimeImmutable(),
            $command->email,
            $this->hasher->hash($command->password),
            $token = $this->tokenizer->generate()
        );

        $this->users->add($user);

        $this->flusher->flush($user);

        return new JsonResponse([
            'email' => $command->email,
        ], 201);
    }
}
