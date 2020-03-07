<?php

namespace Araitta\ImmutableUpdate\NamingRule;

trait CamelCase
{
    protected static function propertyNameFromMatches(string $s): string
    {
        return lcfirst($s);
    }
}
