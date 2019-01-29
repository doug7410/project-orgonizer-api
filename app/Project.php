<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = ['id'];

    public function servers()
    {
        return $this->hasMany(Server::class);
    }
}
