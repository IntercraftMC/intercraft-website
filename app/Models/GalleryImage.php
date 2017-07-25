<?php

namespace App\Models;

class GalleryImage
{
	private $_id;
	private $_userId;
	private $_image;
	private $_description;
	private $_date;

	public static function all()
	{
		$query = db()->prepare("SELECT * FROM `gallery` ORDER BY `date` DESC");
		$query->execute();

		$galleryImages = [];
		foreach ($query->fetchAll() as $galleryImage) {
			$galleryImages[] = new self($galleryImage);
		}

		return $galleryImages;
	}

	public static function fromUser(User $user)
	{
		$queryString = "SELECT * FROM `gallery` WHERE `user_id`=? ORDER BY `date` DESC";
		$args = [ $user->id() ];

		$query = db()->prepare($queryString);
		$query->execute($args);

		$galleryImages = [];
		foreach ($query->fetchAll() as $galleryImage) {
			$galleryImages[] = new self($galleryImage);
		}

		return $galleryImages;
	}

	public function __construct(array $fields = [])
	{
		$this->_id          = fieldInt($fields, 'id');
		$this->_userId      = fieldInt($fields, 'user_id');
		$this->_image       = field($fields, 'image', '');
		$this->_description = field($fields, 'description');
		$this->_date        = field($fields, 'date', date('Y-m-d H:i:s'));
	}

	public function save()
	{
		if ($this->_id === Null) {
			$queryString = "INSERT INTO `gallery` VALUES(NULL, ?, ?, ?, ?)";
			$args = [
				$this->_userId,
				$this->_image,
				$this->_description,
				$this->_date
			];
		} else {
			$queryString = "UPDATE `gallery` SET `user_id`=?, `image`=?, `description`=? `date`=? WHERE `id`=?";
			$args = [
				$this->_userId,
				$this->_image,
				$this->_description,
				$this->_date,
				$this->_id
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

	public function image() { return $this->_image . '.png'; }
	public function thumbnail() { return $this->_image . '_thumb.png'; }
	public function setImage(string $image)
	{
		$this->_image = $image;
		return $this;
	}

	public function description() { return $this->_description; }
	public function setDescription(string $description)
	{
		$this->_description = $description;
		return $this;
	}

	public function date() { return $this->_date; }
	public function setDate(string $date)
	{
		$this->_date = $date;
		return $this;
	}
}