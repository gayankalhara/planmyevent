<?php


namespace App\Models;
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
	/**
         * The table associated with the model.
         *
         * @var string
         */
    protected $table = 'notifications';
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