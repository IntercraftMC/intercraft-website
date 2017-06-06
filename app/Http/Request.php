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
	public function addGetFields(array $fields)
	{
		foreach ($fields as $key=>$value)
			$this->addGetField($key, $value);
		return $this;
	}

	public function postFields() { return $this->_postFields; }
	public function addPostField($key, $value)
	{
		$this->_postFields[$key] = $value;
		return $this;
	}
	public function addPostFields(array $fields)
	{
		foreach ($fields as $key=>$value)
			$this->addPostField($key, $value);
		return $this;
	}

	public function url() { return $this->_url; }
	public function setUrl(string $url, bool $keepUrlParams = True)
	{
		$parts = explode('?', $url);
		$this->_url = $parts[0];

		if ($keepUrlParams && count($parts) > 1) {
			parse_str($parts[1], $params);
			$this->addGetFields($params);
		}

		return $this;
	}

	public function method() { return $this->_method; }
	public function setMethod(string $method)
	{
		$this->_method = $method;
		return $this;
	}

	public function send() {

		$url = "{$this->_url}?" . http_build_query($this->_getFields);

		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_HEADER, True);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, True);
		curl_setopt($c, CURLOPT_MAXREDIRS, 10);
		curl_setopt($c, CURLOPT_AUTOREFERER, True);
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($c, CURLOPT_TIMEOUT, 120);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, True);

		if ($this->_method == 'POST') {
			curl_setopt($c, CURLOPT_POST, count($this->_postFields));
			curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($this->_postFields));
		}

		$result = explode("\r\n\r\n", curl_exec($c), 2);
		$info = curl_getinfo($c);
		curl_close($c);

		$response = new Response($result[1]);
		return $response->addHeadersFromString(explode("\r\n", $result[0], 2)[1])
		                ->setStatusCode($info['http_code']);
	}
}