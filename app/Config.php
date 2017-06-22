<?php

namespace App;

class Config implements \ArrayAccess
{
	private static $_instance;
	private $_container;

	public static function instance()
	{
		return self::$_instance;
	}

	public function __construct(string $directory)
	{
		self::$_instance = $this;

		$this->_container = json_decode(file_get_contents("$directory/config.json"), True);
		$this->_container['blog'] = json_decode(file_get_contents("$directory/blog.json"), True);
		$this->_container['modpack'] = json_decode(file_get_contents("$directory/modpack.json"), True);
		$this->_container['questionnaire'] = json_decode(file_get_contents("$directory/questionnaire.json"), True);
	}

	public function offsetSet($offset, $value)
	{
		if (is_null($offset)) {
			$this->_container[] = $value;
		} else {
			$this->_container[$offset] = $value;
		}
	}

	public function offsetExists($offset)
	{
		return isset($this->_container[$offset]);
	}

	public function offsetUnset($offset)
	{
		unset($this->_container[$offset]);
	}

	public function offsetGet($offset)
	{
		return isset($this->_container[$offset]) ? $this->_container[$offset] : Null;
	}
}