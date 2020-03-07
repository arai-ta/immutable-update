<?php

namespace Atiara\ImmutableUpdate;

use PHPUnit\Framework\TestCase;

class TestingClass
{
    // use trait
    use WithUpdatable;

    // define properties
    private $foo;
    private $barBaz;
    private $quox;

    // NOTE: constructor arguments order must be same order of the property definition
    function __construct($foo, $barBaz, $quox)
    {
        // you can validate or assert input values here
        $this->foo    = $foo;
        $this->barBaz = $barBaz;
        $this->quox   = $quox;
    }

    function __get($name)
    {
        return $this->{$name};
    }
}

class ExampleTest extends TestCase
{

    public function test()
    {
        $obj = new TestingClass('foo', 123, true);

        // you can update & instantiate new object like this;
        $new = $obj->withFoo('FOOOO');

        $this->assertSame('foo', $obj->foo, '$obj is not updated');
        $this->assertSame('FOOOO', $new->foo, '$new is instantiated, and have "FOOOO"');

        $this->assertContainsOnlyInstancesOf(TestingClass::class, [$obj, $new], 'they are same class');
    }

}
