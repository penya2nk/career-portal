<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\job;
use App\models\applier;
use Session;



class userController extends Controller
{
    public function profile()
    {
      # code...
    }

    public function application()
    {
      $applies = applier::where('user_id',Auth::user()->id)->get();

      $data = array('applies' =>$applies);
      return view('my-application')->with($data);
    }
}
