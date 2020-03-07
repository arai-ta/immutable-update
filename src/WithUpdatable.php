<?php

namespace Atiara\ImmutableUpdate;

trait WithUpdatable
{

    public function __call($name, $arguments)
    {
        if (! preg_match('/^with(.*)$/', $name, $matches)) {
            throw new \BadMethodCallException('Undefined method call:'.$name);
        }

        if (method_exists($this, 'namingRule')) {
            $prop_name = static::namingRule($matches[1]);
        } else {
            $prop_name = static::camelCase($matches[1]);
        }

        if (! property_exists($this, $prop_name)) {
            throw new \BadMethodCallException('Property not found:'.$prop_name);
        }

        $new_value = $arguments[0];

        // this feature depends on the order of `get_object_vars` return value
        // and constructor arguments order
        $new_arguments = array_values(
            array_merge(
                get_object_vars($this),
                [$prop_name => $new_value]
            )
        );

        return new static(...$new_arguments);
    }

    protected static function camelCase(string $s): string
    {
        return lcfirst($s);
    }

    protected static function snakeCase(string $s): string
    {
        return ltrim($s, '_');
    }

    protected static function snakePropertyCamelMethod(string $s): string
    {
        return ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', $s)), '_');
    }

}
