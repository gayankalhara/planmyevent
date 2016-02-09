<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionHandler extends Model
{
    protected $table = "sessions";
    public $timestamps = false;
    protected $fillable = ['user_id'];
}
