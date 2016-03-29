<?php

namespace App;
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Indicates if the model should be incremented.
     *
     * @var bool
     */
    public $incrementing = false;


    /**
     * This function is used to get all Quotes for a given User ID
     *
     *
     * @return an instance of the Quote_Requests model
     */
    public function getQuotes()
    {
        return $this->hasMany('App\Models\Quote_Requests', 'UserID');
    }


    /**
     * This function is used to get all Events for a given User ID
     *
     *
     * @return an instance of the Events model
     */
    public function getEvents()
    {
        return $this->hasMany('App\Models\Events', 'UserID');
    }
}
