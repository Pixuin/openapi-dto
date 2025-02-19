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
    expect($classes)->toHaveKey('UserDTODTO');
    expect($classes['UserDTODTO'])->toContain('class UserDTODTO');
    expect($classes['UserDTODTO'])->toContain('private int $id');
    expect($classes['UserDTODTO'])->toContain('private string $name');
    expect($classes['UserDTODTO'])->toContain('private string $email');
});
