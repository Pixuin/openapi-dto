<?php declare(strict_types=1);

namespace Pixuin\OpenapiDTO\DTO;

use Symfony\Component\HttpFoundation\Request;

it('is immutable', function () {
    $userDto = new UserDTO(1, 'John Doe', 'john@example.com');

    expect($userDto->getId())->toBe(1);
    expect($userDto->getName())->toBe('John Doe');
    expect($userDto->getEmail())->toBe('john@example.com');
});

it('can be created from a request', function () {
    $request = new Request(['id' => 1, 'name' => 'Jane Doe', 'email' => 'jane@example.com']);
    $userDto = UserDTO::fromRequest($request);

    expect($userDto->getId())->toBe(1);
    expect($userDto->getName())->toBe('Jane Doe');
    expect($userDto->getEmail())->toBe('jane@example.com');
});

it('can be serialized to JSON', function () {
    $userDto = new UserDTO(1, 'John Doe', 'john@example.com');
    $json = $userDto->jsonSerialize();

    expect($json)->toEqual([
        'id' => 1,
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
});
