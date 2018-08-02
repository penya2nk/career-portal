<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Bogardo\Mailgun\Mail\Message;
use Session;
use Carbon\Carbon;
use Cloudder;

class RegisterController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $val = $this->validator($request->all());

        if ($val->fails()) {
          session::flash('errorregistration','Error');
            return redirect('/register')
                        ->withErrors($val)
                        ->withInput();
        }

        event(new Registered($user = $this->create($request->all())));
        return redirect('/')->with('registerstatus','Registrasi Berhasil, silahkan cek email untuk mengaktifkan');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      $user = new User;
      $user->name = $data['name'];
      $user->email = $data['email'];
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
      $user->token = str_random(20);
      $user->status = 0;
      $user->password =bcrypt($data['password']);
      $user->save();

      $email_data = array('user' =>$user , );

      $this->guard()->login($user);

    }

    public function verify_token($token, $id)
    {

      $user = User::find($id);

      if (!$user) {
        return redirect('/dashboard/login')->with('warningverify', 'User not Found');
      }

      if ($user->token !== $token) {
        return redirect('/dashboard/login')->with('warningverify', 'token not match');
      }

      $user->status = 0;
      $user->save();

      $this->guard()->login($user);
      // dd(session()->flash('status', 'Proses Aktivasi Berhasil, Selamat datang di IPB Training'));

      return redirect ('/dashboard');
    }
}
