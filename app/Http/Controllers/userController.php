<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\job;
use App\models\applier;
use Session;
use App\User;
use Cloudder;
use Carbon\Carbon;




class userController extends Controller
{
    public function profile()
    {
      $user = Auth::user();
      $data = array('user' =>$user , );
      return view('my-profile')->with($data);
    }

    public function application()
    {
      $applies = applier::where('user_id',Auth::user()->id)->get();

      $data = array('applies' =>$applies);
      return view('my-application')->with($data);
    }

    public function edit_profile()
    {
      $user = Auth::user();
      $status = "edit";
      $data = array(
        'user' =>$user,
        'status'=>$status
      );

      return view('auth.register')->with($data);
    }

    public function update_profile(Request $request)
    {
      $data = $request;

      $user = Auth::user();
    
      $user->first_name =$data['first_name'];
      $user->middle_name =$data['middle_name'];
      $user->last_name =$data['last_name'];
      $user->nick_name =$data['nick_name'];
      $user->name = $data['first_name'].' '.$data['middle_name'].' '.$data['last_name'];

      $user->gender = $data['gender'];


      $user->born_date = Carbon::createFromFormat('d-m-Y',$data['born_date']);
      $user->marital_status = $data['marital_status'];
      $user->address = $data['address'];

      $user->last_education = $data['last_education'];
      $user->institution = $data['institution'];
      $user->major = $data['major'];
      $user->graduation_year = $data['graduation_year'];
      $user->gpa = $data['gpa'];
      $user->gpa_max = $data['gpa-max'];
      $user->about = $data['about'];

      if ($data['profpic'] !== NULL) {
        // Image Processing
        $png_url = "career/photo/applier-".str_replace(' ','-',$data['name'])."-".time();
        $img = $data['profpic'];
        $upload_cloudinary = Cloudder::upload($img,$png_url);
        $result = $upload_cloudinary->getResult();
        $photo_url = $result['secure_url'];

        // Cloudinary
        $user->profpic = $photo_url;
      }

      if ($data['resume'] !== NULL) {
        // Image Processing
        $resume_url = "career/resume/resume-".str_replace(' ','-',$data['name'])."-".time();
        $resume = $data['resume'];
        $resume_upload_cloudinary = Cloudder::upload($resume,$resume_url);
        $result_resume = $resume_upload_cloudinary->getResult();
        $resume_url = $result_resume['secure_url'];

        //Cloudinary
        $user->resume = $resume_url;
      }


      $phone_subs = substr($data['phone'],0,4);
      if ($phone_subs == "+620") {
        $phone_subs = substr_replace($data['phone'],"+62",0,4);
      }else {
        $phone_subs = $data['phone'];
      }

      $user->phone = $phone_subs;
      $user->save();



      return redirect()->route('my.profile')->with('success', 'Your profile has been saved');
    }
}
