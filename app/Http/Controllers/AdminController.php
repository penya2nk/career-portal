<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\models\company;
use App\models\job;
use Session;


class AdminController extends Controller
{
    public function index()
    {
      return view('admin.index');
    }

    public function division()
    {
      $companies = company::all();

      $data = array('companies' =>$companies , );
      return view('admin.division')->with($data);
    }

    public function jobvacancy()
    {
      $jobs = job::all();

      $data = array('jobs' =>$jobs , );
      return view('admin.jobvacancy')->with($data);
    }

    public function jobvacancy_add()
    {
      return view('admin.jobvacancyadd');
    }

    public function jobvacancy_create(Request $request)
    {
      $job = new job;
      $job->user_id = Auth::user()->id;
      $job->job_title = $request->job_title;
      $job->time_type = $request->time_type;
      $job->skill_tag = $request->skill_tag;
      $job->job_description = $request->job_description;
      $job->skill_requirement = $request->skill_requirement;
      $job->save();

      Session::flash('status','Job Vacancy Successfully Created');

      return redirect()->route('admin.jobvacancy.index');
    }
}
