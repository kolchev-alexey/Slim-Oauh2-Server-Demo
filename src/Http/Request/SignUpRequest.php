<?php

declare(strict_types=1);

namespace Api\Http\Request;

use Symfony\Component\Validator\Constraints as Assert;

class SignUpRequest
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=6)
     */
    public $password;

    public function __construct($body)
    {
        $this->email = mb_strtolower($body['email'] ?? '');
        $this->password = $body['password'] ?? '';
    }
}
