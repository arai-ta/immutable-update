<?php

namespace Araitta\ImmutableUpdate\NamingRule;

trait SnakeCase
{
    protected static function propertyNameFromMatches(string $s): string
    {
        return ltrim($s, '_');
    }
}
