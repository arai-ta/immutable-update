<?php

namespace Araitta\ImmutableUpdate;

trait ImmutableUpdateTrait
{

    public function __call($name, $arguments)
    {
        if (preg_match('/^with(.*)$/', $name, $matches)) {

            $prop_name = static::propertyNameFromMatches($matches[1]);

            if (property_exists($this, $prop_name)) {
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
        }

        throw new \BadMethodCallException('Undefined method call:'.$name);
    }

    protected static function propertyNameFromMatches(string $matches): string
    {
        return strtolower($matches);
    }

}
