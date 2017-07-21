<?php

namespace App\Nbt;

use ArrayAccess;

class NbtTag implements ArrayAccess
{
	const TAG_END = 0;
	const TAG_BYTE = 1;
	const TAG_SHORT = 2;
	const TAG_INT = 3;
	const TAG_LONG = 4;
	const TAG_FLOAT = 5;
	const TAG_DOUBLE = 6;
	const TAG_BYTE_ARRAY = 7;
	const TAG_STRING = 8;
	const TAG_LIST = 9;
	const TAG_COMPOUND = 10;
	const TAG_INT_ARRAY = 11;

	public function __construct(string $name, int $type, $value)
	{
		$this->_name  = $name;
		$this->_type  = $type;
		$this->_value = $value;
	}

	public function name() { return $this->_name; }
	public function type() { return $this->_type; }
	public function value() { return $this->_value; }

	public function setValue($value)
	{
		$this->_value = $value;
		return $this;
	}

	/* ArrayAccess methods */

	public function offsetExists ($offset)
	{
		if ($this->_type == self::TAG_BYTE_ARRAY || $this->_type == self::TAG_INT_ARRAY)
			if (gettype($this->_value) == 'array')
				return array_key_exists($offset, $this->_value);
		return False;
	}

	public function offsetGet ($offset)
	{
		foreach ($this->_value as $value)
			if ($value->name() == $offset)
				return $value;
		return $this->_value[$offset];
	}

	public function offsetSet ($offset, $value)
	{
		$this->_value[$offset] = $value;
	}

	public function offsetUnset ($offset)
	{
		unset($this->_value[$offset]);
	}
}