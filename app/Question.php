<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{

    use SoftDeletes;

    protected $fillable = [ 'name', 'question_type_id', 'page_id' ];
    protected $dates    = [ 'created_at', 'updated_at', 'deleted_at' ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function type()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function rules()
    {
        return $this->hasMany(QuestionRule::class);
    }

    public function actions()
    {
        return $this->hasMany(QuestionAction::class);
    }

    public function getAnswerCountAttribute()
    {
        return $this->answers->count();
    }
}
