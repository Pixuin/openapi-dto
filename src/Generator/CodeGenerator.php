<?php declare(strict_types=1);

namespace Generator;

use Pixuin\OpenapiDTO\Parser\OpenAPIParser;
use Mustache_Engine;

class CodeGenerator
{
    private OpenAPIParser $parser;
    private Mustache_Engine $mustache;

    public function __construct(OpenAPIParser $parser)
    {
        $this->parser = $parser;
        $this->mustache = new Mustache_Engine();
    }

    /**
     * @return array<string, string>
     */
    public function generate(string $templatePath): array
    {
        $schemas = $this->parser->getSchemas();
        $generatedClasses = [];

        foreach ($schemas as $name => $schema) {
            $className = ucfirst($name) . 'DTO';
            $properties = $this->extractProperties($schema);
            $template = file_get_contents($templatePath) ?: '';
            $classCode = $this->mustache->render($template, [
                'className' => $className,
                'properties' => $properties
            ]);
            $generatedClasses[$className] = $classCode;
        }

        return $generatedClasses;
    }

    /**
     * @param array<string, mixed> $schema
     * @return array<int, array<string, string>>
     */
    private function extractProperties(array $schema): array
    {
        $properties = [];
        if (!is_array($schema['properties'])) {
            throw new \InvalidArgumentException('Schema properties must be an array.');
        }
        foreach ($schema['properties'] as $name => $details) {
            $type = $details['type'] === 'integer' ? 'int' : $details['type'];
            if (!is_string($name) || !is_array($details) || !isset($details['type'])) {
                continue;
            }
            $properties[] = [
                'name' => $name,
                'type' => $type,
                'getterName' => ucfirst($name)
            ];
        }
        return $properties;
    }
}
