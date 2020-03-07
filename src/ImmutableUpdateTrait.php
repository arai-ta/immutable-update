<?php

namespace Araitta\ImmutableUpdate;

trait ImmutableUpdateTrait
{

    public function __call($name, $arguments)
    {
        throw new \BadFunctionCallException('Undefined method call:'.$name);
    }

}
