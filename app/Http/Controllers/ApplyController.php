<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\models\job;
use App\models\applier;
use Session;


class ApplyController extends Controller
{
    public function check_if_exist($id_job, $id_user)
    {
      $check = applier::where([['job_id', $id_job],['user_id', $id_user]])->exists();
      return $check;
    }

    public function apply($id)
    {
      $jobs = job::find($id);
      $user = Auth::user();

      $verification = $this->check_if_exist($jobs->id,$user->id);

      if ($verification == true) {
        Session::flash('status', 'Kamu sudah apply untuk pekerjaan ini');
        return redirect()->route('job.desc',['id'=>$id]);
      }

      $data = array('jobs' =>$jobs , );
      return view('job-apply')->with($data);
    }



    public function post_apply(Request $request, $id)
    {

      $job = job::find($id);
      $user = Auth::user();

      $verification = $this->check_if_exist($job->id,$user->id);

      if ($verification == true) {
        Session::flash('status', 'Kamu sudah apply untuk pekerjaan ini');
        return redirect()->route('job.desc.apply',['id'=>$id]);
      }

      $add = new applier;
      $add->user_id = $user->id;
      $add->job_id = $id;
      $add->skill = serialize($request->skill);
      $add->save();

      return redirect()->route('job.desc',['id'=>$id]);

    }
}
