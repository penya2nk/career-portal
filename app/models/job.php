<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\models\applier;
// use App\models\company;


class job extends Model
{
  use SoftDeletes;
  protected $dates = ['deadline'];

  public function company()
  {
    return $this->belongsTo('App\models\company', 'company_id');
  }

  public function appliers()
  {
    return $this->hasMany(applier::class);
  }

  public function admins()
  {
    return $this->hasMany('App\models\admin', 'job_id');
  }

  public function appraiser()
  {
    return $this->hasMany('App\models\appraiser', 'job_id');
  }

}
