<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\job;
use App\User;
use App\models\stage;

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
}
