<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Rejected_Quotes extends Model
{
    protected $table = 'rejected_quotes';

    protected $primaryKey = 'QuoteID';

    public $incrementing = false;

    public $timestamps = false;
}