<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';

    public $incrementing = false;

    public $timestamps = false;
}