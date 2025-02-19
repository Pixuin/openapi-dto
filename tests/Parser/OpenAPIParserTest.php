<?php declare(strict_types=1);

namespace Pixuin\OpenapiDTO\Parser;

use RuntimeException;

it('parses valid OpenAPI JSON and retrieves schemas', function () {
    $parser = new OpenAPIParser();
    $parser->parse(__DIR__ . '/../test_openapi.json');

    $schemas = $parser->getSchemas();

    expect($schemas)->toBeArray();
    expect($schemas)->toHaveKey('User');
    expect($schemas['User'])->toHaveKey('properties');
    expect($schemas['User']['properties'])->toHaveKey('id');
    expect($schemas['User']['properties']['id'])->toHaveKey('type');
    expect($schemas['User']['properties']['id']['type'])->toBe('integer');
});

it('throws an exception for invalid JSON', function () {
    $parser = new OpenAPIParser();
    expect(fn() => $parser->parse(__DIR__ . '/../invalid_openapi.json'))->toThrow(RuntimeException::class);
});
