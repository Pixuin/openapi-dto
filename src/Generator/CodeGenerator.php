<?php

namespace App\Generator;

use App\Parser\OpenAPIParser;
use Mustache_Engine;

class CodeGenerator
{
    private $parser;
    private $mustache;

    public function __construct(OpenAPIParser $parser)
    {
        $this->parser = $parser;
        $this->mustache = new Mustache_Engine();
    }

    public function generate(string $templatePath): array
    {
        $schemas = $this->parser->getSchemas();
        $generatedClasses = [];

        foreach ($schemas as $name => $schema) {
            $className = ucfirst($name) . 'DTO';
            $properties = $this->extractProperties($schema);
            $template = file_get_contents($templatePath);
            $classCode = $this->mustache->render($template, [
                'className' => $className,
                'properties' => $properties
            ]);
            $generatedClasses[$className] = $classCode;
        }

        return $generatedClasses;
    }

    private function extractProperties(array $schema): array
    {
        $properties = [];
        foreach ($schema['properties'] as $name => $details) {
            $properties[] = [
                'name' => $name,
                'type' => $details['type']
            ];
        }
        return $properties;
    }
}
