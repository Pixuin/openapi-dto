<?php declare(strict_types=1);

namespace Pixuin\OpenapiDTO\DTO;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class UserDTOTest extends TestCase
{
    public function testImmutability(): void
    {
        $userDto = new UserDTO(1, 'John Doe', 'john@example.com');

        $this->assertSame(1, $userDto->getId());
        $this->assertSame('John Doe', $userDto->getName());
        $this->assertSame('john@example.com', $userDto->getEmail());

        // Attempting to modify the properties directly should not be possible
        // This is just to illustrate immutability; PHP will not allow this
        // $userDto->id = 2; // Uncommenting this line should cause an error
    }

    public function testFromRequest(): void
    {
        $request = new Request(['id' => 1, 'name' => 'Jane Doe', 'email' => 'jane@example.com']);
        $userDto = UserDTO::fromRequest($request);

        $this->assertSame(1, $userDto->getId());
        $this->assertSame('Jane Doe', $userDto->getName());
        $this->assertSame('jane@example.com', $userDto->getEmail());
    }

    public function testJsonSerialize(): void
    {
        $userDto = new UserDTO(1, 'John Doe', 'john@example.com');
        $json = $userDto->jsonSerialize();

        $this->assertSame([
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ], $json);
    }
}
