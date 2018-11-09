<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{

    use SoftDeletes;

    protected $fillable = [ 'name', 'survey_id' ];
    protected $dates    = [ 'created_at', 'updated_at', 'deleted_at' ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getQuestionCountAttribute()
    {
        return $this->questions->count();
    }
}
