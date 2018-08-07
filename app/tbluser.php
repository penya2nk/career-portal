<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class tbluser extends Model
{
  protected $connection = 'mysql2';
  protected $table = 'tbluser';
  public    $incrementing = false;
  protected $primaryKey = 'id_user';
    use SoftDeletes;
}
