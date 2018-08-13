<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['born_date'];
    protected $year = [ 'year', 'graduation_year'];

    public function parameters()
    {
      return $this->belongsToMany('App\models\parameter','user_parameter')
        ->withPivot('score','lock','comment','user_submit')
        ->withTimestamps();
    }

    public function stages()
    {
        return $this->belongsTo('App\models\stage', 'stage_id');
    }

    public function appliers()
    {
      return $this->hasMany('App\models\applier','user_id');
    }

    public function experiences()
    {
      return $this->hasMany('App\models\employhistory','user_id');
    }
}
