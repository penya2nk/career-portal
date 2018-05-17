<?php

namespace App\models;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'tblcompany';
      use SoftDeletes;
}
