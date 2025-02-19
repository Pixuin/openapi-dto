<?php declare(strict_types=1);

namespace Pixuin\OpenapiDTO\Writer;

use PHPUnit\Framework\TestCase;

class CodeWriterTest extends TestCase
{
    public function testWriteCreatesDirectoryAndFiles(): void
    {
        $outputDir = __DIR__ . '/../../output_test';
        $classes = [
            'UserDTODTO' => '<?php declare(strict_types=1); namespace DTO; class UserDTODTO { private int $id; private string $name; private string $email; }',
        ];

        $writer = new CodeWriter();
        $writer->write($classes, $outputDir);

        $this->assertDirectoryExists($outputDir);
        $this->assertFileExists($outputDir . '/UserDTODTO.php');

        // Clean up
        array_map('unlink', glob("$outputDir/*.*"));
        rmdir($outputDir);
    }
}
