<?php declare(strict_types=1);

namespace Pixuin\OpenapiDTO\Generator;

use Pixuin\OpenapiDTO\Parser\OpenAPIParser;

beforeEach(function () {
    $this->parser = new OpenAPIParser();
    $this->parser->parse(__DIR__ . '/../../test_openapi.json');
    $this->namespace = 'App\\DTO'; // Set the namespace
    $this->generator = new CodeGenerator($this->parser, $this->namespace); // Pass the namespace here
});

it('generates classes from OpenAPI schema', function () {
    $templatePath = __DIR__ . '/../../templates/dto.mustache';
    $classes = $this->generator->generate($templatePath);

    expect($classes)->toBeArray();
    expect($classes)->toHaveKey('UserDTO');
    expect($classes['UserDTO'])->toContain('namespace App\\DTO;'); // Check for the correct namespace
    expect($classes['UserDTO'])->toContain('class UserDTO');
    expect($classes['UserDTO'])->toContain('private int $id');
    expect($classes['UserDTO'])->toContain('private string $name');
    expect($classes['UserDTO'])->toContain('private string $email');
});
