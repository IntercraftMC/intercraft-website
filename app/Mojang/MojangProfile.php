<?php

namespace App\Mojang;

class MojangProfile
{
	private $_uuid;
	public function __construct(array $info)
	{
		$this->_uuid = $info['id'];
		$this->_username = $info['name'];
	}

	public function uuid() { return $this->_uuid; }
	public function username() { return $this->_username; }
}