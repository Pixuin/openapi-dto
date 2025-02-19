<?php declare(strict_types=1);

namespace Pixuin\OpenapiDTO\Generator;

use Pixuin\OpenapiDTO\Parser\OpenAPIParser;

beforeEach(function () {
    $this->parser = new OpenAPIParser();
    $this->parser->parse(__DIR__ . '/../../test_openapi.json');
    $this->generator = new CodeGenerator($this->parser);
});

it('generates classes from OpenAPI schema', function () {
    $templatePath = __DIR__ . '/../../templates/dto.mustache';
    $classes = $this->generator->generate($templatePath);

    expect($classes)->toBeArray();
    expect($classes)->toHaveKey('UserDTO'); // Changed from 'UserDTODTO' to 'UserDTO'
    expect($classes['UserDTO'])->toContain('class UserDTO'); // Changed from 'UserDTODTO' to 'UserDTO'
    expect($classes['UserDTO'])->toContain('private int $id'); // Changed from 'UserDTODTO' to 'UserDTO'
    expect($classes['UserDTO'])->toContain('private string $name'); // Changed from 'UserDTODTO' to 'UserDTO'
    expect($classes['UserDTO'])->toContain('private string $email'); // Changed from 'UserDTODTO' to 'UserDTO'
});
