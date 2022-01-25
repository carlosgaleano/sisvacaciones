<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\User;
use Validator;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Requests;

class AdminUser extends Controller
{
    //
  

    public function create(Request $data)
    {
        $this->validate($data, [
            'username' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'rol' => 'required',
        ]);
        // dd( $data);

        $id_role = $data['rol'] == 'admin' ? 1 : 2;

        //dd($id_role);
        User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'rol' => $data['rol'],
            'role_id' => $id_role,
            'password' => bcrypt($data['password']),
            'api_token' => str_random(50),
            'remember_token' => str_random(10),

        ]);

        $usuarios = User::all();

        return view('auth.lista')
            ->with('usuarios', $usuarios);
    }
}
