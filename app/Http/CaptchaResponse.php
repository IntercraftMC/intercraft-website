<?php

namespace App\Http;

class CaptchaResponse
{
	private $_success;
	private $_timestamp;
	private $_hostName;
	private $_errorCodes;

	public function __construct($json = [])
	{
		$this->_success = field($json, 'success', False);
		$this->_timestamp = field($json, 'timestamp', date('Y-m-d').'T'.date('H:i:s').'Z');
		$this->_hostName = field($json, 'hostname', HOST_NAME);
		$this->_errorCodes = field($json, 'error-codes', []);
	}

	public function isSuccess()
	{
		return $this->_success;
	}

	public function timestamp()
	{
		return $this->timestamp;
	}

	public function hostName()
	{
		return $this->hostName;
	}

	public function errorCodes()
	{
		return $this->_errorCodes;
	}
}