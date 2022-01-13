<?php

namespace App\Http\Controllers;

use App\Worker;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\VacationController;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wokersr = Worker::where('state',1);
        $datos=$wokersr->get()->toArray();
        //print_r($datos[0]['date_in']);
        //dd($datos);
        
    
        $vacaciones= new VacationController;
       if($datos){
            $result=$vacaciones->calcular_dias($datos[0]['date_in']);
        }else{
            $result=null;
        }
       
//print_r(auth()->user()->role_id);

       
      $role_id=auth()->user()->role_id;

      if($role_id==2){

        return redirect('/worker/infoVacation/');
       //dd return view('/worker/infoVacation/',compact('result'));
      }else{
          return view('home')->with('workers',$wokersr->get())
                           ->with('result',$result);
      }
        
    }

    public function welcome(){
        if (\Auth::check()) {
            return redirect('/home');
        }
        return redirect('/');
    }
}
