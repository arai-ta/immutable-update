<?php

namespace Araitta\ImmutableUpdate\NamingRule;

trait SnakePropertyCamelMethod
{
    protected static function propertyNameFromMatches(string $s): string
    {
        return ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', $s)), '_');
    }
}