<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\models\company;
use App\models\job;
use App\tbluser;
use App\User;
use App\models\admin;
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
      // Integrasi blst
      $tbluser =tbluser::all();
      $data = array('tbluser' =>$tbluser , );

      return view('admin.jobvacancyadd')->with($data);
    }

    public function check_admin_exists($job_id, $id_blst)
    {
      $check = admin::where([['job_id', $job_id],['id_blst', $id_blst]])->exists();
      return $check;
    }

    public function jobvacancy_create(Request $request)
    {
      $job = new job;
      $job->user_id = Auth::user()->id;
      $job->job_title = $request->job_title;
      $job->company_id = $request->company_id;
      $job->published = $request->published;
      $job->deadline = $request->deadline;
      $job->stages_list = serialize($request->stage);
      $job->time_type = $request->time_type;
      $job->skill_tag = $request->skill_tag;
      $job->job_description = $request->job_description;
      $job->skill_requirement = $request->skill_requirement;
      $job->work_location = $request->work_location;
      $job->min_experience = $request->min_experience;
      $job->save();

      // integrasi BLST
      if ($request->id_blst !== NULL) {
        foreach ($request->id_blst as $key => $value) {
          $check_ada_admin = $this->check_admin_exists($job->id, $value);
          if (!$check_ada_admin) {
            $addadmin = new admin;
            $addadmin->job_id = $job->id;
            $addadmin->id_blst = $value;

            $tbluser =tbluser::where('id_user', $value)->first();
            if ($tbluser !== NULL) {
              $addadmin->email = $tbluser->email;
            }

            $addadmin->save();
          }
        }
      }

      Session::flash('status','Job Vacancy Successfully Created');

      return redirect()->route('admin.jobvacancy.index');
    }

    public function jobvacancy_edit($id)
    {

      $tbluser =tbluser::all();

      $job = job::find($id);
      $status = 'edit';
      $user_maker = User::find($job->user_id);



      $data = array('job' =>$job,
                    'status'=> $status,
                    'tbluser'=>$tbluser
                    );

                    // integrasi BLST
                    $user = Auth::user();
                    $id_blst = $user->id_blst;
                    $email = $user->email;

                    $admin_able = admin::where([['job_id', $id],['id_blst',$id_blst]])->exists();
                    $owner = $user_maker->id == Auth::user()->id;

                    if (!$admin_able && !$owner) {
                      Session::flash('error','Anda belum menjadi bagian admin dari lowongan kerja ini. Hubungi '.$user_maker->name.' selaku pembuat lowongan');
                      return redirect()->route('admin.jobvacancy.index');
                    }


      return view('admin.jobvacancyadd')->with($data);
    }

    public function jobvacancy_edit_post(Request $request, $id)
    {

      $job = job::find($id);
      $job->published = $request->published;
      $job->company_id = $request->company_id;
      $job->stages_list = serialize($request->stage);
      $job->job_title = $request->job_title;
      $job->time_type = $request->time_type;
      $job->deadline = $request->deadline;
      $job->skill_tag = $request->skill_tag;
      $job->job_description = $request->job_description;
      $job->skill_requirement = $request->skill_requirement;
      $job->work_location = $request->work_location;
      $job->min_experience = $request->min_experience;
      $job->update();

      // integrasi BLST
      if ($request->id_blst !== NULL) {
        foreach ($request->id_blst as $key => $value) {
          $check_ada_admin = $this->check_admin_exists($job->id, $value);
          if (!$check_ada_admin) {
            $addadmin = new admin;
            $addadmin->job_id = $job->id;
            $addadmin->id_blst = $value;

            $tbluser =tbluser::where('id_user', $value)->first();
            if ($tbluser !== NULL) {
              $addadmin->email = $tbluser->email;
            }

            $addadmin->save();
          }
        }
      }

      Session::flash('status','Job Vacancy Successfully Edited');

      return redirect()->route('admin.jobvacancy.index');
    }

    public function jobvacancy_delete(Request $request,$id)
    {

      $tbluser =tbluser::all();
      $job = job::find($id)->delete();
      $user_maker = User::find($job->user_id);

                    // integrasi BLST
                    $user = Auth::user();
                    $id_blst = $user->id_blst;
                    $email = $user->email;

                    $admin_able = admin::where([['job_id', $id],['id_blst',$id_blst]])->exists();
                    $owner = $user_maker->id == Auth::user()->id;

                    if (!$admin_able && !$owner) {
                      Session::flash('error','Anda belum menjadi bagian admin dari lowongan kerja ini. Hubungi '.$user_maker->name.' selaku pembuat lowongan');
                      return redirect()->route('admin.jobvacancy.index');
                    }


      Session::flash('status','Job Vacancy Successfully Deleted');
      return redirect()->route('admin.jobvacancy.index');
    }
}
