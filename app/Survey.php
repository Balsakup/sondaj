<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{

    use SoftDeletes;

    protected $fillable = [ 'name', 'description' ];
    protected $dates    = [ 'created_at', 'updated_at', 'deleted_at' ];
    protected $hidden   = [ 'created_at', 'updated_at', 'deleted_at' ];

    public function pages()
    {
        return $this->hasMany(Page::class)->orderBy('position', 'ASC');
    }

    public function replies()
    {
        return $this->hasMany(SurveyReply::class);
    }

    public function getPageCountAttribute()
    {
        return $this->pages->count();
    }
}
