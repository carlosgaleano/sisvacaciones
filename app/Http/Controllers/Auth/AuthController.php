<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $loginView = 'welcome';
    protected $username = 'username';
    protected $redirectAfterLogout = '/home';
    protected $loginPath = '/welcome';


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware($this->guestMiddleware(), ['except' => ['logout','showRegisterForm','register','listUser','create']]);
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
            'username' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'rol' =>'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

       // dd( $data);
      //$this->validator( $data);
        $id_role=$data['rol']=='admin'?1:2;

       //dd($id_role);
       return  User::create([
            'username'=>$data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'rol' =>$data['rol'],
            'role_id' =>$id_role,
            'password' => bcrypt($data['password']),
            'api_token' => str_random(50),
            'remember_token' => str_random(10),
           
        ]);

         // $this->listUser();
    }

    public function listUser(){

        $usuarios=User::all();

        return view('auth.lista')
                ->with('usuarios',$usuarios);

    }
    public function showRegisterForm(){

        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('welcome');
    }
}
