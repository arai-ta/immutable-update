<?php

namespace Araitta\ImmutableUpdate;

trait CamelCase
{
    protected static function propertyNameFromMatches(string $s): string
    {
        return lcfirst($s);
    }
}
