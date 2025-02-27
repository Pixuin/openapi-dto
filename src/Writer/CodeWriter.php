<?php declare(strict_types=1);

namespace Pixuin\OpenapiDTO\Writer;

use RuntimeException;
use Whoops\Exception\ErrorException;

class CodeWriter
{
    /**
     * @param array<string, string> $classes
     */
    public function write(array $classes, string $outputDir): void
    {
        if (!is_dir($outputDir)) {
            if (!@mkdir($outputDir, 0777, true)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $outputDir));
            }
        }

        foreach ($classes as $className => $classCode) {
            $filePath = $outputDir . DIRECTORY_SEPARATOR . $className . '.php';
            if (file_put_contents($filePath, $classCode) === false) {
                throw new RuntimeException(sprintf('Failed to write file "%s"', $filePath));
            }
        }
    }
}
