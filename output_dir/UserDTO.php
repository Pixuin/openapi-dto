<?php

namespace App\DTO;

use Symfony\Component\HttpFoundation\Request;

class UserDTO
{
    private readonly integer $id;
    private readonly string $name;
    private readonly string $email;

    public function __construct(integer $id, string $name, string $email, )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function get(): integer
    {
        return $this->id;
    }
    public function get(): string
    {
        return $this->name;
    }
    public function get(): string
    {
        return $this->email;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->get('id'), $request->get('name'), $request->get('email'), 
        );
    }
}
