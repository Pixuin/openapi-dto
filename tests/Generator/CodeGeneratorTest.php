<?php declare(strict_types=1);

namespace Pixuin\OpenapiDTO\Generator;

use Pixuin\OpenapiDTO\Parser\OpenAPIParser;
use PHPUnit\Framework\TestCase;

class CodeGeneratorTest extends TestCase
{
    private OpenAPIParser $parser;
    private CodeGenerator $generator;

    protected function setUp(): void
    {
        $this->parser = new OpenAPIParser();
        $this->parser->parse(__DIR__ . '/../../test_openapi.json');
        $this->generator = new CodeGenerator($this->parser);
    }

    public function testGenerateClasses(): void
    {
        $templatePath = __DIR__ . '/../../templates/dto.mustache';
        $classes = $this->generator->generate($templatePath);

        $this->assertArrayHasKey('UserDTODTO', $classes);
        $this->assertStringContainsString('class UserDTODTO', $classes['UserDTODTO']);
        $this->assertStringContainsString('private int $id', $classes['UserDTODTO']);
        $this->assertStringContainsString('private string $name', $classes['UserDTODTO']);
        $this->assertStringContainsString('private string $email', $classes['UserDTODTO']);
    }
}
