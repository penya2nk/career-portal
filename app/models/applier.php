<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\job;
use App\User;
use App\models\stage;
use App\models\parameter;

class applier extends Model
{
    public function user()
    {
      return $this->belongsTo(user::class);
    }

    public function job()
    {
      return $this->belongsTo(job::class);
    }

    public function stage()
    {
      return $this->belongsTo(stage::class);
    }

    public function user_parameters()
    {
      return $this->belongsTo('App\models\user_parameter', 'parameter_id');
    }
}
