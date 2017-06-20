<?php

namespace App\Mojang;

class MojangStatus
{
	public const GREEN  = 2;
	public const YELLOW = 1;
	public const RED    = 0;

	private $_serverInfo;

	public function __construct(array $serverInfo)
	{
		$this->_serverInfo = [];
		foreach ($serverInfo as $server) {
			$key = array_keys($server)[0];
			$this->_serverInfo[$key] = $this->map($server[$key]);
		}
	}

	protected function map(string $value)
	{
		switch($value) {
			case 'green':
				return self::GREEN;
			case 'yellow':
				return self::YELLOW;
			default:
				return self::RED;
		}
	}

	public function minecraftStatus() { return $this->_serverInfo['minecraft.net']; }
	public function sessionStatus() { return $this->_serverInfo['session.minecraft.net']; }
	public function accountStatus() { return $this->_serverInfo['account.mojang.com']; }
	public function authStatus() { return $this->_serverInfo['auth.mojang.com']; }
	public function skinsStatus() { return $this->_serverInfo['skins.minecraft.net']; }
	public function authServerStatus() { return $this->_serverInfo['authserver.mojang.com']; }
	public function sessionServerStatus() { return $this->_serverInfo['sessionserver.mojang.com']; }
	public function apiStatus() { return $this->_serverInfo['api.mojang.com']; }
	public function texturesStatus() { return $this->_serverInfo['textures.minecraft.com']; }
	public function mojangStatus() { return $this->_serverInfo['mojang.com']; }
}