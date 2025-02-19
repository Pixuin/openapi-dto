<?php declare(strict_types=1);

namespace Pixuin\OpenapiDTO\Writer;

beforeEach(function () {
    $this->outputDir = __DIR__ . '/../../output_test'; // Ensure this directory is writable
    $this->classes = [
        'UserDTO' => '<?php declare(strict_types=1); namespace DTO; class UserDTO { private int $id; private string $name; private string $email; }',
    ];
    $this->writer = new CodeWriter();
});

it('creates directory and files when writing classes', function () {
    $this->writer->write($this->classes, $this->outputDir);

    expect(is_dir($this->outputDir))->toBeTrue();
    expect(file_exists($this->outputDir . '/UserDTO.php'))->toBeTrue();

    // Clean up
    array_map('unlink', glob("$this->outputDir/*.*"));
    rmdir($this->outputDir);
});

it('throws an exception if the directory cannot be created', function () {
    $invalidOutputDir = '/invalid_directory_path'; // Use an absolute path that is invalid
    $this->expectException(\RuntimeException::class);
    $this->writer->write($this->classes, $invalidOutputDir);
});
