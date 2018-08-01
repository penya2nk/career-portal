<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\models\applier;
// use App\models\company;


class job extends Model
{
  use SoftDeletes;

  public function company()
  {
    return $this->belongsTo('App\models\company', 'company_id');
  }

  public function appliers()
  {
    return $this->hasMany(applier::class);
  }

}
