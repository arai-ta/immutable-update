<?php

namespace Araitta\ImmutableUpdate;

trait SnakeCase
{
    protected static function propertyNameFromMatches(string $s): string
    {
        return ltrim($s, '_');
    }
}
