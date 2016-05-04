<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'readStatus', 'body', 'icon', 'link'];
}
