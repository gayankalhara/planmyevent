<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote_Requests extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quote_requests';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    /**
     * Indicates if the model should be incremented.
     *
     * @var bool
     */
    public $incrementing = false;


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * This function is used to get all Services for a given Quote ID
     *
     *
     * @return an instance of the Requested_Services model
     */
    public function getServices()
    {
        return $this->hasMany('App\Models\Requested_Services', 'QuoteID');
    }
}