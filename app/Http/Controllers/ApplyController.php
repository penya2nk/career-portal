<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function apply($id)
    {
      return view('job-apply');
    }
}
