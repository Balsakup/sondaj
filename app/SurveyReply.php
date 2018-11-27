<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyReply extends Model
{

    use SoftDeletes;

    protected $fillable = [ 'ended_at', 'survey_id' ];
    protected $dates    = [ 'ended_at', 'created_at', 'updated_at', 'deleted_at' ];
    protected $hidden   = [ 'survey_id', 'created_at', 'updated_at', 'deleted_at' ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
