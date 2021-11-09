<?php

declare(strict_types=1);

namespace Api\Model\User\Entity\User;

interface UserRepository
{
    public function hasByEmail(string $email): bool;

    public function getByEmail(string $email): User;

    public function add(User $user): void;
}
