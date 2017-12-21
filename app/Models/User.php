<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $hidden = ["password"];
    protected $guarded = ["password"];

    public function generateAccessToken()
    {
        $this->token = randomHexString(32);
        return $this;
    }

    public function profile()
    {
        return $this->hasOne("App\Models\Profile");
    }


    public function uuids()
    {
        return json_decode($this->uuids);
    }

    public function checkPassword(string $password)
    {
        return password_verify($password, $this->password);
    }

    public function setPassword(string $password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        return $this;
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
