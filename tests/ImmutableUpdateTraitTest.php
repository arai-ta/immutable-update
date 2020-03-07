<?php

namespace Araitta\ImmutableUpdate;

use PHPUnit\Framework\TestCase;

class ImmutableUpdateTraitTest extends TestCase
{

    public function test()
    {
        $obj = new class {
            use ImmutableUpdateTrait;
        };

        $obj->meth();
    }

}

