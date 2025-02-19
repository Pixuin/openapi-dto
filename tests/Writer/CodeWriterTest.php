<?php declare(strict_types=1);

namespace Pixuin\OpenapiDTO\Writer;

beforeEach(function () {
    $this->outputDir = __DIR__ . '/../../output_test';
    $this->classes = [
        'UserDTODTO' => '<?php declare(strict_types=1); namespace DTO; class UserDTODTO { private int $id; private string $name; private string $email; }',
    ];
    $this->writer = new CodeWriter();
});

it('creates directory and files when writing classes', function () {
    $this->writer->write($this->classes, $this->outputDir);

    expect(is_dir($this->outputDir))->toBeTrue();
    expect(file_exists($this->outputDir . '/UserDTODTO.php'))->toBeTrue();

    // Clean up
    array_map('unlink', glob("$this->outputDir/*.*"));
    rmdir($this->outputDir);
});
