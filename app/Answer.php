<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{

    use SoftDeletes;

    protected $fillable = [ 'name', 'value', 'question_id', 'position' ];
    protected $dates    = [ 'created_at', 'updated_at', 'deleted_at' ];
    protected $hidden   = [ 'question_id', 'created_at', 'updated_at', 'deleted_at' ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
