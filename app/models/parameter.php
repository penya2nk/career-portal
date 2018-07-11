<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class parameter extends Model
{
    use SoftDeletes;

    public function stage()
    {
      return $this->belongsTo('App\models\stage','stage_id');
    }

    public function users()
    {
      return $this->belongsToMany('App\user','user_parameter')
        ->withPivot('score','lock','comment','user_submit')
        ->withTimestamps();
    }
}
