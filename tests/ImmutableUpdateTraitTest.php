<?php

namespace Araitta\ImmutableUpdate;

use PHPUnit\Framework\TestCase;

class TestingClass
{
    use ImmutableUpdateTrait;

    private $foo;
    private $bar;
    private $baz;

    public function __construct($foo, $bar, $baz)
    {
        $this->foo = $foo;
        $this->bar = $bar;
        $this->baz = $baz;
    }

    public function dump()
    {
        return get_object_vars($this);
    }

}

class ImmutableUpdateTraitTest extends TestCase
{

    public function test()
    {
        $obj = new TestingClass("FOO", "BAR", "BAZ");

        $new = $obj->withFoo("Ninja");

        $this->assertNotSame($obj, $new, '$new is a new instance');
        $this->assertInstanceOf(TestingClass::class, $new);
        $this->assertSame(['foo' => 'Ninja', 'bar' => "BAR", 'baz' => 'BAZ'], $new->dump());
    }

}

