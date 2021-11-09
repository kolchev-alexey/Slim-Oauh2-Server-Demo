<?php

declare(strict_types=1);

namespace Api\Http\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ConfirmRequest
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;
    /**
     * @Assert\NotBlank()
     */
    public $token;

    public function __construct($body)
    {
        $this->email = $body['email'] ?? '';
        $this->token = $body['token'] ?? '';
    }
}
