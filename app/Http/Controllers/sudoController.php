<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\tbluser;

class sudoController extends Controller
{
    public function gate_sdmblst()
    {

      $user_email = base64_decode($_GET['us']);
      $user_pass = base64_decode($_GET['ps']);
      $user_company = base64_decode($_GET['co']);
      $user_id = base64_decode($_GET['id']);

      $check_tbluser = tbluser::where('email', $user_email)->exists();
      $check_exist = user::where('email', $user_email)->exists();
      if ($check_exist && $check_tbluser) {
        $user = User::where('email', $user_email)->first();
        $tes = Auth::login($user);
        return redirect('/admin')->withInput();
      }elseif($check_tbluser) {

        $user_blst = $check_tbluser = tbluser::where('email', $user_email)->first();
        $user = new User;
        $user->name = $user_blst->name_user;
        $user->email = $user_email;
        $user->token = str_random(20);
        $user->status = 0;
        $user->userlevel = 1;

        if ($user_blst->id_gender = "1") {
          $gender = "L";
        }else {
          $gender = "P";
        }

        $user->born_date = $user_blst->tgl_born;
        $user->born_place = $user_blst->born_place_kab;
        $user->phone = $user_blst->phno1;
        $user->gender = $gender;
        $user->address = $user_blst->address_origin;
        $user->profpic = "https://system.ipbsciencetechnopark.com/images/foto/'.$user_blst->id_user.'.jpeg";      

        $user->company_id = $user_company;
        $user->password =bcrypt($user_pass);
        $user->id_blst = $user_id;
        $user->save();

        $email_data = array('user' =>$user , );

        // $this->guard()->login($user);
        $tes = Auth::login($user);
        return redirect('/admin')->withInput();
      }

    }
}
