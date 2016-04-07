<?php

namespace App;
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
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

    /**
     * Set todo Date Added
     *
     * @param  string  $value
     * @return string
     */
    public function getDateAdded($value)
    {
        return Carbon::parse(attributes['date_added'])->format('l jS \\of F Y h:i:s A');
    }



     
}
