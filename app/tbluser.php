<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbluser extends Model
{
  protected $connection = 'mysql2';
  protected $table = 'tbluser';
  protected $primaryKey = 'id_user';
    use SoftDeletes;
}
