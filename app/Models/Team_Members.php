<?php

namespace App;
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Team_Members extends Model
{
    	/**
         * The table associated with the model.
         *
         * @var string
         */
    protected $table = 'team_members';


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
}
