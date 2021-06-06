<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{

    /**
     * Subscribers
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
