# Immutable Update

A php trait that helps safe update for immutable objects.

## Why?

Immutable objects and complete constructor are useful idea.

Sometimes, you wants to replace partial properties of object. 
You should instantiate new object with new value, because 
immutable object is not changeable.
Or you may define a method in this case, like this;

```php
public function withRequest($request): self
{
    $new = clone $this;
    $new->request = $request;
    return $new;
}
```

But there are some problems;

- Boilerplate code.
- Validation is troublesome.

This library is intended to solve this problem.

## Install

    $ composer require atiara/immutable-update

## How to use

Please see [example](tests/ExampleTest.php).

## License

MIT.
