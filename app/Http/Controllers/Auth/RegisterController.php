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
            'handphone' => 'required|string|min:6',
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
      dd($data);

      $user = new User;
      $user->name = $data['name'];
      $user->email = $data['email'];
      // $user->gender = $data['title'];

      $phone_subs = substr($data['handphone'],0,4);
      if ($phone_subs == "+620") {
        $phone_subs = substr_replace($data['handphone'],"+62",0,4);
      }else {
        $phone_subs = $data['handphone'];
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
