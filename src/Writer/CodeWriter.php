<?php declare(strict_types=1);

namespace Writer;

class CodeWriter
{
    /**
     * @param array<string, string> $classes
     */
    public function write(array $classes, string $outputDir): void
    {
        if (!is_dir($outputDir) && !mkdir($outputDir, 0777, true) && !is_dir($outputDir)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $outputDir));
        }

        foreach ($classes as $className => $classCode) {
            $filePath = $outputDir . DIRECTORY_SEPARATOR . $className . '.php';
            file_put_contents($filePath, $classCode);
        }
    }
}
