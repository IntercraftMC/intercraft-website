<?php

namespace App\Models;

class BlogPost
{
	private $_id;
	private $_userId;
	private $_title;
	private $_image;
	private $_body;
	private $_views;
	private $_date;

	public static function all()
	{
		$query = db()->prepare("SELECT * FROM `blog`");
		$query->execute();

		$blogs = [];
		foreach ($query->fetchAll() as $blogs) {
			$blogs[] = new self($blogs);
		}

		return $blogs;
	}

	public function __construct(array $fields = [])
	{
		$this->_id        = fieldInt($fields, 'id');
		$this->_userId    = fieldInt($fields, 'user_id');
		$this->_title			= field($fields, 'title', '');
		$this->_image			= field($fields, 'image', '');
		$this->_body			= field($fields, 'body', '');
		$this->_views			= fieldInt($fields, 'views', 0);
		$this->_date			= field($fields, 'date', date('Y-m-d H:i:s'));
	}

	public function save()
	{
		if ($this->_id === Null) {
			$queryString = "INSERT INTO `blog` VALUES(NULL, ?, ?, ?, ?, ?, ?)";
			$args = [
				$this->_userId,
				$this->_title,
				$this->_image,
				$this->_body,
				$this->_views,
				$this->_date
			];
		} else {
			$queryString = "UPDATE `blog` SET `title`=?, `image`=?, `body`=?, `views`=?, `date`=? WHERE `id`=?";
			$args = [
				$this->_title,
				$this->_image,
				$this->_body,
				$this->_views,
				$this->_date,
				$this->_id
			];
		}

		$query = db()->prepare($queryString);
		$query->execute($args);
		d($query->errorInfo());
	}

	public function id() { return $this->_id; }
	public function userId() { return $this->_userId; }

	public function setUser(User $user)
	{
		$this->_userId = $user->id();
		return $this;
	}

	public function title() { return $this->_title; }
	public function setTitle(string $title)
	{
		$this->_title = $title;
		return $this;
	}

	public function image() { return $this->_image; }
	public function setImage(string $image)
	{
		$this->_image = $image;
		return $this;
	}

	public function body() { return $this->_body; }
	public function setBody(string $body)
	{
		$this->_body = $body;
		return $this;
	}

	public function views() { return $this->_views; }
	public function setViews(int $views)
	{
		$this->_views = $views;
		return $this;
	}

	public function date() { return $this->_date; }
	public function setDate(int $year, int $month, int $day)
	{
		$this->_date = "$year-$month-$day 0:0:0";
		return $this;
	}
}
