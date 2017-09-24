<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Blog extends Model
{
    protected $table = "blog";

    /**
     * Fetch the author's user modal
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }

    /**
     * Get the post date using Carbon
     * @return Carbon\Carbon
     */
    public function date()
    {
    	return new Carbon($this->created_at);
    }

    /**
     * Get the archive date
     * @return string
     */
    public function archive()
    {
    	return $this->date()->format("F Y");
    }

    /**
     * Get the readable date
     * @return string
     */
    public function dateReadable()
    {
        return $this->date()->toDateString();
    }

    /**
     * Get the most recent three posts
     * @param  Laravel Stuffs $query
     * @return Array<App\Models\Blog>
     */
    public function scopeRecent($query)
    {
        return $query->orderBy("id", "desc")->take(3)->get();
    }

    /**
     * Get the most recent three posts
     * @param  Laravel Stuffs $query
     * @param  string $slug
     * @return Array<App\Models\Blog>
     */
    public function scopeSlug($query, $slug)
    {
    	return $query->where("id", $slug)->first();
    }

    /**
     * Fetch the categories, with the number of posts in that category
     * @return Array<string, int>
     */
    public static function categories()
    {
        $categories = config('blog.categories');
        for($i = 0; $i < count($categories); $i++) {
            $results[] = [
                'name' => $categories[$i],
                'count' => static::where('category_id', $i)->count()
            ];
        }
        return $results;
    }

    /**
     * Fetch all of the archives, with the number of posts in each archive
     * @return Array[string, int]
     */
    public static function archives()
    {
        $posts = Blog::orderBy("id", "desc")->get();
        $results = [];

        foreach ($posts as $post)
        	if (!isset($results[$post->archive()]))
        		$results[$post->archive()] = 1;
        	else
        		$results[$post->archive()]++;

        return $results;
    }
}
