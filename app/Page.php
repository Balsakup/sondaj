<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{

    use SoftDeletes;

    protected $fillable = [ 'name', 'survey_id', 'position' ];
    protected $dates    = [ 'created_at', 'updated_at', 'deleted_at' ];
    protected $hidden   = [ 'survey_id', 'created_at', 'updated_at', 'deleted_at' ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('position', 'ASC');
    }

    public function getQuestionCountAttribute()
    {
        return $this->questions->count();
    }
}
