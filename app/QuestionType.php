<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{

    protected $dates  = [ 'created_at', 'updated_at' ];
    protected $hidden = [ 'created_at', 'updated_at' ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
