<?php

namespace App\Models;

use DateTime;

class BlogPost
{
	private $_id;
	private $_userId;
	private $_categoryId;
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
		foreach ($query->fetchAll() as $blog) {
			$blogs[] = new self($blog);
		}

		return $blogs;
	}

	public static function fromId(int $id)
	{
		$query = db()->prepare("SELECT * FROM `blog` WHERE `id`=?");
		$query->execute([$id]);

		if ($query->rowCount() == 0)
			return Null;

		return new self($query->fetchAll()[0]);
	}

	public static function categories()
	{
		$posts = self::all();
		$categories = [];
		foreach ($posts as $post) {
			$category = $post->category();
			if (!isset($categories[$category]))
				$categories[$category] = [
					'category' => $category,
					'total' => 0
				];
			$categories[$category]['total']++;
		}
		return $categories;
	}

	public static function archives()
	{
		$posts = self::all();
		$archives = [];
		foreach ($posts as $post) {
			$archive = $post->archive();
			if (!isset($archives[$archive]))
				$archives[$archive] = [
					'date' => $archive,
					'total' => 0
				];
			$archives[$archive]['total']++;
		}
		return $archives;
	}

	public function __construct(array $fields = [])
	{
		$this->_id         = fieldInt($fields, 'id');
		$this->_userId     = fieldInt($fields, 'user_id');
		$this->_categoryId = fieldInt($fields, 'category_id');
		$this->_title      = field($fields, 'title', '');
		$this->_image      = field($fields, 'image', '');
		$this->_brief      = field($fields, 'brief', '');
		$this->_body       = field($fields, 'body', '');
		$this->_views      = fieldInt($fields, 'views', 0);
		$this->_date       = field($fields, 'date', date('Y-m-d H:i:s'));
	}

	public function save()
	{
		if ($this->_id === Null) {
			$queryString = "INSERT INTO `blog` VALUES(NULL, ?, ?, ?, ?, ?, ?)";
			$args = [
				$this->_userId,
				$this->_categoryId,
				$this->_title,
				$this->_image,
				$this->_brief,
				$this->_body,
				$this->_views,
				$this->_date
			];
		} else {
			$queryString = "UPDATE `blog` SET `category_id`=?, `title`=?, `image`=?, `brief`=?, `body`=?, `views`=?, `date`=? WHERE `id`=?";
			$args = [
				$this->_categoryId,
				$this->_title,
				$this->_image,
				$this->_brief,
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

	public function user() { return User::fromId($this->_userId); }
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

	public function image() { return "assets/blog/" . $this->_image . '.png'; }
	public function setImage(string $image)
	{
		$this->_image = $image;
		return $this;
	}

	public function brief() { return $this->_brief; }
	public function setBrief(string $brief)
	{
		$this->_brief = $brief;
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

	public function comments() { return []; }

	public function date() { return $this->_date; }
	public function dateReadable()
	{
		$date = new DateTime($this->_date);
		return $date->format('M j, Y');
	}
	public function archive()
	{
		$date = new DateTime($this->_date);
		return $date->format('M Y');
	}
	public function setDate(int $year, int $month, int $day)
	{
		$this->_date = "$year-$month-$day";
		return $this;
	}

	public function category() { return config()['blog']['categories'][$this->_categoryId];	}
	public function categoryId() { return $this->_categoryId; }
	public function setCategoryId(int $categoryId)
	{
		$this->_categoryId = $categoryId;
		return $this;
	}
}
