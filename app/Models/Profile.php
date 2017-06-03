<?php

namespace App\Models;

use App\Models\User;

class Profile
{
	private $_id;
	private $_userId;
	private $_name;
	private $_gender;
	private $_birthdate;
	private $_desc;

	public static function fromUser(User $user)
	{
		$query = db()->prepare("SELECT * FROM `profiles` WHERE `user_id`=?");
		$query->execute([$user->id()]);

		if ($query->rowCount() == 0)
			return Null;

		return new self($query->fetchAll()[0]);
	}

	public function __construct(array $fields = [])
	{
		$this->_id        = fieldInt($fields, 'id');
		$this->_userId    = fieldInt($fields, 'user_id');
		$this->_name      = field($fields, 'name');
		$this->_gender 	  = field($fields, 'gender');
		$this->_birthdate = field($fields, 'birthdate');
		$this->_desc      = field($fields, 'description');
	}

	public function save()
	{
		if ($this->_id === Null) {
			$queryString = "INSERT INTO `profiles` VALUES(NULL, ?, ?, ?, ?, ?)";
			$args = [
				$this->_userId,
				$this->_name,
				$this->_gender,
				$this->_age,
				$this->_description
			];
		} else {
			$queryString = "UPDATE `profiles` SET `name`=?, `gender`=?, `age`=?, `description`=? WHERE `id`=?";
			$args = [
				$this->_name,
				$this->_gender,
				$this->_age,
				$this->_description
			];
		}

		$query = db()->prepare($queryString);
		$query->execute($args);
	}

	public function id() { return $this->_id; }
	public function userId() { return $this->_userId; }

	public function setUser(User $user)
	{
		$this->_userId = $user->id();
		return $this;
	}

	public function name() { return $this->_name; }
	public function setName(string $name)
	{
		$this->_name = $name;
		return $this;
	}

	public function gender() { return $this->_gender; }
	public function setGender(string $gender)
	{
		$this->_gender = $gender;
		return $this;
	}

	public function birthDate() { return $this->_birthDate; }
	public function setBirthDate(int $year, int $month, $day)
	{
		$this->_birthDate = date("$year/$month/$day");
		return $this;
	}

	public function description() { return $this->_desc === Null ? 'No description set.' : $this->_desc; }
	public function setDescription($description)
	{
		$this->_desc = $description;
		return $this;
	}
}