<?php
/**
 * Created by PhpStorm.
 * User: lmart
 * Date: 20/12/2018
 * Time: 17:37
 */

class StringList implements ArrayAccess, IteratorAggregate
{
    protected $items = [];

    public function offsetSet($key, $value)
    {
        if (is_string($value)) {

            $key ? $this->items[$key] = $value : array_push($this->items, $value);

            return $this;
        }

        throw new \UnexpectedValueException('Essa é uma lista que aceita somente string');
    }

    public function offsetGet($key)
    {
        return $this->items[$key];
    }

    public function offsetExists($key)
    {
        return isset($this->items[$key]);
    }

    public function offsetUnset($key)
    {
        unset($this->items[$key]);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }
}