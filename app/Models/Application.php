<?php

namespace App\Models;

class Application
{
	private $_id;
	private $_email;
	private $_username;
	private $_uuid;
	private $_answers;
	private $_date;

	public static function all()
	{
		$query = $db()->prepare("SELECT * FROM `applications`");
		$query->execute();

		$applications = [];
		foreach ($query->fetchAll() as $application) {
			$applications[] = new self($application);
		}

		return $applications;
	}

	public function __construct(array $fields = [])
	{
		$this->_id       = fieldInt($fields, 'id');
		$this->_email    = field($fields, 'email', '');
		$this->_username = field($fields, 'username', '');
		$this->_uuid     = field($fields, 'uuid', '');
		$this->_answers  = field($fields, 'answers', '');
		$this->_date     = field($fields, 'date', date('Y-m-d H:i:s'));
	}

	public function save()
	{
		if ($this->_id === Null) {
			$queryString = "INSERT INTO `applications` VALUES(NULL, ?, ?, ?, ?, ?)";
			$args = [
				$this->_email,
				$this->_username,
				$this->_uuid,
				$this->_answers,
				$this->_date
			];
		} else {
			$queryString = "UPDATE `applications` SET `email`=?, `username`=?, `uuid`=?, `answers`=?, `date`=? WHERE `id`=?";
			$args = [
				$this->_email,
				$this->_username,
				$this->_uuid,
				$this->_answers,
				$this->_date,
				$this->_id
			];
		}

		$query = db()->prepare($queryString);
		$query->execute($args);
	}

	public function id() { return $this->_id; }

	public function email() { return $this->_email; }
	public function setEmail(string $email)
	{
		$this->_email = $email;
		return $this;
	}

	public function username() { return $this->_username; }
	public function setUsername(string $username)
	{
		$this->_username = $username;
		return $this;
	}

	public function uuid() { return $this->_uuid; }
	public function setUuid(string $uuid)
	{
		$this->_uuid = $uuid;
		return $this;
	}

	public function answers() { return $this->_answers; }
	public function setAnswers(string $answers)
	{
		$this->_answers = $answers;
		return $this;
	}

	public function date() { return $this->_date; }
	public function setDate(int $year, int $month, int $day)
	{
		$this->_date = "$year-$month-$day 0:0:0";
		return $this;
	}
}