# OpenAPI DTO Generator

![Build Status](https://img.shields.io/github/actions/workflow/status/Pixuin/openapi-dto/ci.yml?branch=main)
![Coverage](https://img.shields.io/badge/coverage-93.02%25-brightgreen)
![PHP Version](https://img.shields.io/badge/php-8.3%2B-blue)
![PHPStan](https://img.shields.io/badge/PHPStan-level%20max-brightgreen)
![Pest](https://img.shields.io/badge/tests-passed-brightgreen)

OpenAPI DTO Generator is a PHP 8.3 command-line tool that reads an OpenAPI specification (the `openapi.json` file) and generates immutable Data Transfer Object (DTO) classes based on the definitions in the schemas. The generated classes are designed according to SOLID principles, and access to internal values is provided exclusively through public getter methods, allowing for customization by subclasses.

## Project Goals

- **Immutable DTO Classes**: Generate immutable Data Transfer Object classes from OpenAPI specifications.
- **SOLID Principles**: Ensure that the generated code adheres to SOLID principles for better maintainability and extensibility.
- **Dynamic Namespace**: Allow users to specify a namespace for the generated classes via command line arguments.
- **Factory Methods**: Include factory methods for creating instances from HTTP requests.
- **Modular Design**: Structure the project into clear modules (Parser, Code Generator, Writer, Tests) with well-defined responsibilities.
- **Unit Testing**: Implement unit tests using Pest to verify the functionality of the generator, parser, and writer.

## Project Structure

- **bin/**: Contains the executable script for running the generator.
- **src/**: Contains the main source code, including the parser, generator, writer, and DTO classes.
- **templates/**: Contains Mustache templates for generating the DTO classes.
- **tests/**: Contains unit tests for the parser, generator, and writer.
- **config/**: Contains configuration files for the generator.
- **vendor/**: Contains third-party dependencies managed by Composer.

## Requirements

- PHP 8.3 or newer
- Composer
- (Optional) Symfony HttpFoundation (for handling HTTP requests)
- Pest (for unit testing)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Pixuin/openapi-dto.git
   cd openapi-dto
   ```

2. Install dependencies using Composer:
   ```bash
   composer install
   ```

## Usage

### Running the Generator

Run the generator from the command line:
```bash
php bin/openapi-dto-generator --input=/path/to/openapi.json --output=/path/to/generated/classes --namespace="App\DTO"
```

**Parameters:**

- `--input` – path to the `openapi.json` file (can also be a URL)
- `--output` – directory where the DTO classes will be generated
- `--namespace` – root namespace for the generated classes

### Generated DTO Classes

Each generated class:
- Has private readonly properties that are initialized only in the constructor.
- Does not provide public setter methods – access to internal values is provided exclusively through public getter methods (e.g., `getName()`, `getId()`). This allows subclasses to override these methods for custom behavior.
- Contains a static factory method `fromRequest(Request $request): self`, which creates an instance from an HTTP request.

### Example of Using Generated DTO

```php
use App\DTO\UserRequestDTO;
use Symfony\Component\HttpFoundation\Request;

// Create an HTTP request (e.g., using Symfony HttpFoundation)
$request = Request::createFromGlobals();

// Create DTO using the factory method
$userDto = UserRequestDTO::fromRequest($request);

// Access values through getters
echo $userDto->getName();
```

### Running Tests

Tests are written using the Pest framework (https://pestphp.com/). To run the tests, use the following command:
```bash
vendor/bin/pest
```

Tests verify:
- Correct loading and parsing of the OpenAPI specification.
- Generation of DTO classes with the correct properties and getter methods.
- Immutability of generated objects.

## Extending and Customizing

The project is modular and easily extendable:
- **Templates**: Code is generated using Mustache templates. To modify the generated code, edit the templates in the `templates/` directory.
- **Configuration**: The `config/generator.php` file allows you to set custom rules (e.g., type mappings, class prefixes/suffixes).

## Architecture

The project is divided into the following modules:
- **Parser**: Loads and processes the OpenAPI specification.
- **Code Generator**: Converts internal data structures into PHP classes using templates.
- **Writer**: Writes the generated code to the file system.
- **Tests**: Unit tests (Pest) verifying key functionality.

Overall, the goal is to provide a robust and maintainable solution with clearly separated responsibilities that supports customization (through overridden getter methods) and allows easy integration into any project.

## Contributing

If you have ideas for improvements or find bugs, please create an issue or pull request in the repository.

## License

This project is licensed under the [MIT License](LICENSE).

## Author

Vladimir Polak <vladimir.polak.ml@gmail.com>
