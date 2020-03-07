<?php

namespace Araitta\ImmutableUpdate;

use stdClass;
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

    public function testBadMethod()
    {
        $this->expectException(\BadMethodCallException::class);

        $obj = new class { use ImmutableUpdateTrait; };
        $obj->noSuchMethod('hoge');
    }

    public function testBadProperty()
    {
        $this->expectException(\BadMethodCallException::class);

        $obj = new class { use ImmutableUpdateTrait; };
        $obj->withHoge('hoge');
    }

    public function testVariousTypes()
    {
        $obj = new class('str', 123, false, new stdClass) {

            private $string;
            private $int;
            private $bool;
            private $object;

            use ImmutableUpdateTrait;

            public function __construct(string $s, int $i, bool $b, stdClass $o) 
            {
                $this->string = $s;
                $this->int    = $i;
                $this->bool   = $b;
                $this->object = $o;
            }

            public function __get($name)
            {
                return $this->{$name};
            }
        };

        $new = $obj->withString("tokyo")
                   ->withBool(true)
                   ->withObject((object)['var' => 'value']);
        
        $this->assertSame("tokyo",  $new->string);
        $this->assertSame(123,      $new->int);
        $this->assertSame(true,     $new->bool);
        $this->assertSame("value",  $new->object->var);
    }

}

