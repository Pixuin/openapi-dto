<?php declare(strict_types=1);

use Pest\Plugin;

Plugin::add('tests/Parser', 'tests/Generator', 'tests/Writer', 'tests/DTO');
