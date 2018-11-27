<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{

    protected $fillable = [ 'name', 'label' ];
    protected $dates    = [ 'created_at', 'updated_at' ];
    protected $hidden   = [ 'created_at', 'updated_at' ];
}
