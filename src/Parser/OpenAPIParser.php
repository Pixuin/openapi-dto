<?php

namespace Pixuin\OpenapiDTO\Parser;

class OpenAPIParser
{
    /** @var array<string, array<string, mixed>> */
    private array $schemas = [];

    public function parse(string $filePath): void
    {
        $jsonContent = file_get_contents($filePath) ?: '';
        $openapiData = json_decode($jsonContent, true);
        if (!is_array($openapiData)) {
            throw new \RuntimeException('Invalid JSON format.');
        }

        if (isset($openapiData['components']) && is_array($openapiData['components']) &&
            isset($openapiData['components']['schemas']) && is_array($openapiData['components']['schemas'])) {
            $this->schemas = $openapiData['components']['schemas'];
        }
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function getSchemas(): array
    {
        return $this->schemas;
    }
}
