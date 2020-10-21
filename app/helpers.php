<?php

/**
 * Converts a string from kebab-case to PascalCase.
 */
function kebabToPascal(string $str): string
{
    return str_replace('-', '', ucwords($str, '-'));
}
