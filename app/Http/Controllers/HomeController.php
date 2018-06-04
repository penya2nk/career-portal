<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\job;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = job::all();
        $data = array('jobs' =>$jobs,);

        return view('home')->with($data);
    }

    public function job($id)
    {
      $job = job::find($id);
      $data = array('job' =>$job,);
      return view('job-description')->with($data);
    }
}
