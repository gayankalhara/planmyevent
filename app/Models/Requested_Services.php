<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requested_Services extends Model
{
    protected $table = 'requested_services';

    protected $primaryKey = 'QuoteID';

    public $incrementing = false;

    public $timestamps = false;
}