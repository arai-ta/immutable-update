<?php

namespace Araitta\ImmutableUpdate;

trait ImmutableUpdateTrait
{

    public function __call($name, $arguments)
    {
        if (preg_match('/^with(.*)$/', $name, $matches)) {

            $prop_name = $matches[1];

            $prop_name = strtolower($prop_name);

            if (property_exists($this, $prop_name)) {
                $new_value = $arguments[0];

                $current = get_object_vars($this);

                $mixed = array_merge($current, [$prop_name => $new_value]);

                $next = array_values($mixed);

                return new static(...$next);
            }
        }

        throw new \BadFunctionCallException('Undefined method call:'.$name);
    }

}
