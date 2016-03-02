<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event_types extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event_types';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Show a list of all event categories
     *
     * @return Response
     */
    // public function index()
    // {
    //     $eventCategories = event_types::all();

    //     return view('question-builder', ['event_types' => $eventCategories]);
    // }
}
