<?php

namespace App\Writer;

class CodeWriter
{
    public function write(array $classes, string $outputDir): void
    {
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        foreach ($classes as $className => $classCode) {
            $filePath = $outputDir . DIRECTORY_SEPARATOR . $className . '.php';
            file_put_contents($filePath, $classCode);
        }
    }
}
