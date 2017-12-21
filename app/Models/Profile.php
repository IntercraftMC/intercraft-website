<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function primaryUuid()
    {
        return $this->primary_uuid;
    }
}
