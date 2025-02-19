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

        if (isset($openapiData['components']['schemas'])) {
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
