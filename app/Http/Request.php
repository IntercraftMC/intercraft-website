<?php

namespace App\Http;


class Request
{
	const GET = 'GET';
	const POST = 'POST';

	private $_getFields = [];
	private $_postFields = [];
	private $_url;
	private $_method;

	function __construct($url = '', $method = self::GET)
	{
		$this->setUrl($url);
		$this->setMethod($method);
	}

	public function getFields() { return $this->_getFields; }
	public function addGetField($key, $value)
	{
		$this->_getFields[$key] = $value;
		return $this;
	}

	public function postFields() { return $this->_postFields; }
	public function addPostField($key, $value)
	{
		$this->_postFields[$key] = $value;
		return $this;
	}

	public function url() { return $this->_url; }
	public function setUrl(string $url, bool $keepUrlParams = True)
	{
		$parts = explode('?', $url);
		$this->_url = $parts[0];
		return $this;
	}

	public function method() { return $this->_method; }
	public function setMethod(string $method)
	{
		$this->_method = $method;
		return $this;
	}

	public function send() {

		$url = http_build_query($this->_getFields);

		d($url);
		// rtrim($fieldString, '&');

		// $c = curl_init();
		// curl_setopt($c, CURLOPT_URL, $url);
		// curl_setopt($c, CURLOPT_POST, count($fields));
		// curl_setopt($c, CURLOPT_POSTFIELDS, $fieldString);
		// curl_setopt($c, CURLOPT_RETURNTRANSFER, True);
		// $result = json_decode(curl_exec($c), True);
		// curl_close($c);
	}
}