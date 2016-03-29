<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Approved_Quotes extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'approved_quotes';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'QuoteID';


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
     * This function is used to get all Requested Services for a given Approved Quote
     *
     *
     * @return an instance of the Requested_Services model
     */
    public function getRequestedServices()
    {
        return $this->hasMany('App\Models\Requested_Services', 'QuoteID');
    }
}