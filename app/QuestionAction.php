<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionAction extends Model
{

    use SoftDeletes;

    protected $fillable = [ 'conditions', 'question_id', 'action_id' ];
    protected $dates    = [ 'created_at', 'updated_at', 'deleted_at' ];
    protected $hidden   = [ 'action_id', 'question_id', 'created_at', 'updated_at', 'deleted_at' ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function action()
    {
        return $this->belongsTo(Action::class);
    }
}
