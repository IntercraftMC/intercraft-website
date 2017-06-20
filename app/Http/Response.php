<?php

namespace App\Http;

class Response
{
	private $_content;
	private $_headers;
	private $_statusCode;

	public function __construct(string $content = Null, array $headers = [])
	{
		$this->_content = $content;
		$this->_headers = $headers;
		$this->_statusCode = 200;
	}

	public function headers() { return $this->_headers; }
	public function addHeader(string $key, $value)
	{
		$this->_headers[$key] = $value;
		return $this;
	}
	public function addHeadersFromString(string $headerString)
	{
		$headerString = str_replace("\r\n", "\n", $headerString);
		$lines = explode("\n", $headerString);
		foreach ($lines as $line) {
			$parts = explode(':', $line, 2);
			$this->addHeader($parts[0], $parts[1]);
		}
		return $this;
	}

	public function statusCode() { return $this->_statusCode; }
	public function setStatusCode(int $code)
	{
		$this->_statusCode = $code;
		return $this;
	}

	public function content() { return $this->_content; }
	public function setContent(string $content)
	{
		$this->_content = $content;
	}

	public function send()
	{
		http_response_code($this->_statusCode);
		foreach ($this->_headers as $key=>$value)
			header("$key: $value");

		if ($this->_content !== Null)
			echo $this->_content;
	}
}