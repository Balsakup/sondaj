<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionRule extends Model
{

    use SoftDeletes;

    protected $fillable = [ 'conditions', 'question_id', 'rule_id' ];
    protected $dates    = [ 'created_at', 'updated_at', 'deleted_at' ];
    protected $hidden   = [ 'rule_id', 'question_id', 'created_at', 'updated_at', 'deleted_at' ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }
}
