<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\job;
use App\User;

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
}
