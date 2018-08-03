<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\models\company;
use App\models\job;
use Session;


class AdminController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('checkadmin');
    }


    public function index()
    {
      return redirect()->route('admin.jobvacancy.index');
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
      $jobs = job::orderBy('created_at', 'desc')->get();

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
      $job->company_id = $request->company_id;
      $job->published = $request->published;
      $job->stages_list = serialize($request->stage);
      $job->time_type = $request->time_type;
      $job->skill_tag = $request->skill_tag;
      $job->job_description = $request->job_description;
      $job->skill_requirement = $request->skill_requirement;
      $job->work_location = $request->work_location;
      $job->min_experience = $request->min_experience;
      $job->save();

      Session::flash('status','Job Vacancy Successfully Created');

      return redirect()->route('admin.jobvacancy.index');
    }

    public function jobvacancy_edit($id)
    {
      $job = job::find($id);
      $status = 'edit';

      $data = array('job' =>$job,
                    'status'=> $status
                    );
      return view('admin.jobvacancyadd')->with($data);
    }

    public function jobvacancy_edit_post(Request $request, $id)
    {

      $job = job::find($id);
      $job->user_id = Auth::user()->id;
      $job->published = $request->published;
      $job->company_id = $request->company_id;
      $job->stages_list = serialize($request->stage);
      $job->job_title = $request->job_title;
      $job->time_type = $request->time_type;
      $job->skill_tag = $request->skill_tag;
      $job->job_description = $request->job_description;
      $job->skill_requirement = $request->skill_requirement;
      $job->work_location = $request->work_location;
      $job->min_experience = $request->min_experience;
      $job->update();

      Session::flash('status','Job Vacancy Successfully Edited');

      return redirect()->route('admin.jobvacancy.index');
    }

    public function jobvacancy_delete(Request $request,$id)
    {
      $job = job::find($id)->delete();
      Session::flash('status','Job Vacancy Successfully Deleted');
      return redirect()->route('admin.jobvacancy.index');
    }
}
