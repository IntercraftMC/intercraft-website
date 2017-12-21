<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function profile()
    {
        return $this->hasOne("App\Models\Profile");
    }

    public function uuids()
    {
        return json_decode($this->uuids);
    }

    public function scopeActive($query)
    {
    	return $query->where('active', 1);
    }

    public function scopeAdmins($query)
    {
    	return $query->where('active', 1)->where('privilege', 2)->get();
    }

    public function scopeVips($query)
    {
    	return $query->where("active", 1)->where("privilege", 1)->get();
    }

    public function scopeCitizens($query)
    {
    	return $query->where("active", 1)->where("privilege", 0)->get();
    }

    public function scopeId($query, int $id)
    {
        return $query->where("id", $id);
    }
}
