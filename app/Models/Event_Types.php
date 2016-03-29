<?php
/**
 * Created by PhpStorm.
 * User: Hasitha
 * Date: 3/7/2016
 * Time: 1:04 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_Types extends Model
{
    protected $table = 'event_types';

    public $incrementing = false;

    public $timestamps = false;
}