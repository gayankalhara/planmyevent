<?php

namespace App;
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{

	protected $primaryKey = 'todo_id';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'todo';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Indicates if the model should be incremented.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'date_added', 'description', 'date_completed', 'date_deleted', 'date_archieved', 'status'
    ];
}
