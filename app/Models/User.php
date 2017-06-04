<?php

namespace App\Models;

use App\Models\Profile;
use App\Crypto;

class User
{
	public const ADMIN = 2;
	public const MODERATOR = 1;
	public const NORMAL = 0;

	private $_id;
	private $_privilege;
	private $_active;
	private $_email;
	private $_username;
	private $_password;
	private $_date;
	private $_uuid;

	private $_profile;

	public static function all()
	{
		$query = db()->prepare("SELECT * FROM `users`");
		$query->execute();
		
		$users = [];
		foreach ($query->fetchAll() as $user) {
			$users[] = new self($user);
		}

		return $users;
	}

	public static function allActive()
	{
		$query = db()->prepare("SELECT * FROM `users` WHERE `active`=?");
		$query->execute([1]);
		
		$users = [];
		foreach ($query->fetchAll() as $user) {
			$users[] = new self($user);
		}

		return $users;
	}

	public static function fromId(int $id)
	{
		$query = db()->prepare("SELECT * FROM `users` WHERE `id`=?");
		$query->execute([$id]);

		if ($query->rowCount() == 0)
			return Null;
		
		return new self($query->fetchAll()[0]);
	}

	public static function fromEmail(string $email)
	{
		$query = db()->prepare("SELECT * FROM `users` WHERE `email`=?");
		$query->execute([$email]);

		if ($query->rowCount() == 0)
			return Null;
		
		return new self($query->fetchAll()[0]);
	}

	public static function fromUsername(string $username)
	{
		$query = db()->prepare("SELECT * FROM `users` WHERE `username`=?");
		$query->execute([$username]);

		if ($query->rowCount() == 0)
			return Null;
		
		return new self($query->fetchAll()[0]);
	}

	public static function fromToken(string $token)
	{
		$query = db()->prepare("SELECT * FROM `users` WHERE `token`=?");
		$query->execute([$token]);

		if ($query->rowCount() == 0)
			return Null;
		
		return new self($query->fetchAll()[0]);
	}

	public function __construct(array $fields = [])
	{
		$this->_id        = fieldInt($fields, 'id');
		$this->_privilege = fieldInt($fields, 'privilege', 0);
		$this->_active    = fieldInt($fields, 'active', 0);
		$this->_email     = field($fields, 'email');
		$this->_username  = field($fields, 'username');
		$this->_password  = field($fields, 'password');
		$this->_date      = field($fields, 'date', date('Y-m-d H:i:s'));
		$this->_uuid      = field($fields, 'uuid');
		$this->_token     = field($fields, 'token');

		if ($this->_id === Null)
			$this->_profile = new Profile(['user_id' => $this->_id]);
		else
			$this->_profile = Profile::fromUser($this);
	}

	public function save()
	{
		$new = False;
		if ($this->_id === Null) {
			$new = True;
			$queryString = "INSERT INTO `users` VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, NULL)";
			$args = [
				$this->_privilege,
				$this->_active,
				$this->_email,
				$this->_username,
				$this->_password,
				$this->_date,
				$this->_uuid
			];
		} else {
			$queryString = "UPDATE `users` SET `privilege`=?, `active`=?, `email`=?, `username`=?, `password`=?, `uuid`=?, `token`=? WHERE `id`=?";
			$args = [
				$this->_privilege,
				$this->_active,
				$this->_email,
				$this->_username,
				$this->_password,
				$this->_uuid,
				$this->_token,
				$this->_id
			];
		}

		$query = db()->prepare($queryString);
		$query->execute($args);

		if ($new === True) {
			$this->_profile->setUser($this);
		}
	}

	public function profile() { return $this->_profile; }

	public function isAdmin() { return $this->_privilege == self::ADMIN; }
	public function isModerator() { return $this->_privilege == self::MODERATOR; }
	public function isNormal() { return $this->_privilege == self::NORMAL; }

	public function id() { return $this->_id; }
	public function date() { return $this->_date; }

	public function privilege() { return $this->_privilege; }
	public function privilegeString() { return config()['user']['privilege'][$this->_privilege]; }
	public function setPrivilege(int $privilege)
	{
		$this->_privilege = $privilege;
		return $this;
	}

	public function active() { return $this->active; }
	public function setActive(bool $active)
	{
		$this->_active = $active;
		return $this;
	}

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

	public function password() { return $this->_password; }
	public function setPasswordHash(string $hash)
	{
		$this->_password = $hash;
		return $this;
	}
	public function setPassword(string $password)
	{
		$this->_password = password_hash($password, PASSWORD_BCRYPT);
		return $this;
	}

	public function uuid() { return $this->_uuid; }
	public function setUuid($uuid)
	{
		$this->_uuid = $uuid;
		return $this;
	}

	public function token() { return $this->_token; }
	public function generateToken()
	{
		$this->_token = Crypto::generateAccessToken();
		return $this;
	}
}