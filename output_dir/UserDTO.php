<?php declare(strict_types=1);

namespace Pixuin\OpenapiDTO\DTO;

use Symfony\Component\HttpFoundation\Request;

class UserDTO implements \JsonSerializable
{
{
````

templates/dto.mustache
````mustache
<<<<<<< SEARCH
    }
{
    private readonly int $id;
    private readonly string $name;
    private readonly string $email;

    public function __construct(int $id, string $name, string $email, )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            /** @phpstan-ignore-next-line */
            $request->get('id'), $request->get('name'), $request->get('email')
        );
    }
}
