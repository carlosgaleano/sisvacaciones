<?php

namespace App\Http\Controllers;

use App\Area;
use App\User;
use App\Worker;
use App\Vacation;
use Illuminate\Http\Request;
use App\Http\Controllers\VacationController;
use DB;  

use App\Http\Requests;

class WorkerController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function create()
    {
        $areas = Area::lists('name', 'id')->toArray();
        $user = User::where('role_id', 2)->lists('name', 'id')->toarray();
        return view('worker.create')->with('areas', $areas)
            ->with('user', $user);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'ci' => 'required',
            'cellphone' => 'required',
            'photo' => 'required',
            'date_in' => 'required',
            'position' => 'required',
            'email' => 'required',
            'area_id' => 'required',
            'user_id' => 'required'
        ]);


        $worker = new Worker();
        $worker->name = $request['name'];
        $worker->ci = $request['ci'];
        $worker->cellphone = $request['cellphone'];
        $worker->photo = $request['photo'];
        $worker->date_in = date("Y-m-d", strtotime($request['date_in']));
        $worker->date_out = 0;
        $worker->position = $request['position'];
        $worker->email = $request['email'];
        $worker->state = '1';
        $worker->area_id = $request['area_id'];
        $worker->user_id = $request['user_id'];

        $worker->save();

        return redirect('/home');
    }

    public function upload(Request $request)
    {
        if ($request->file('file')) {
            //upload an image to the /img/tmp directory and return the filepath.
            $file = $request->file('file');
            $tmpFilePath = '/img/tmp/';
            $tmpFileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path = $tmpFilePath . $tmpFileName;
            return response()->json(array('path' => $path), 200);
        } else {
            return response()->json(false, 200);
        }
    }

    public function show($id)
    {
        try {
            $decrypted_id = \Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect('/home');
        }
        $worker = Worker::find($decrypted_id);
        return view('worker.show')->with('worker', $worker);
    }

    public function edit($id)
    {
        try {
            $decrypted_id = \Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect('/home');
        }
        $worker = Worker::find($decrypted_id);
        $areas = Area::lists('name', 'id')->toArray();
        return view('worker.edit')->with('worker', $worker)->with('areas', $areas);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'ci' => 'required',
            'cellphone' => 'required',
            'photo' => 'required',
            'date_in' => 'required',
            'position' => 'required',
            'email' => 'required',
            'area_id' => 'required'
        ]);

        $worker = Worker::find($request['id_worker']);
        $worker->name = $request['name'];
        $worker->ci = $request['ci'];
        $worker->cellphone = $request['cellphone'];
        $worker->photo = $request['photo'];
        $worker->date_in = date("Y-m-d", strtotime($request['date_in']));
        $worker->date_out = 0;
        $worker->position = $request['position'];
        $worker->email = $request['email'];
        $worker->area_id = $request['area_id'];
        $worker->save();

        return redirect('/home');
    }

    public function remove(Request $request)
    {
        $this->validate($request, [
            'id_worker' => 'required',
            'fecha_retiro' => 'required',
            'motivo_retiro' => 'required',
        ]);
        $worker = Worker::find($request['id_worker']);
        $worker->state = '0';
        $worker->date_out = date("Y-m-d", strtotime($request['fecha_retiro']));
        $worker->reason_retirement = $request['motivo_retiro'];
        $worker->save();
        return redirect('/home');
    }

    public function retirados()
    {
        $workers = Worker::where('state', 0);
        return view('worker.retirados')->with('workers', $workers->get());
    }


    public function state()
    {
        return 'hola';
    }

    public function infoVacation()
    {

        $id = auth()->user()->id;

        $datosUser = new \stdClass;
        $datosUser->name = auth()->user()->name;
        $datosUser->id = auth()->user()->id;


        
      
        $worker = Worker::where('user_id', '=', $id)->first();
        //$solicitudes= Vacation::where('worker_id', '=', $worker->id)->get();
       // $vacaciones=$vacaciones->toArray();
       //dd( $solicitudes);

      //dd($solicitudes) ;
      if($worker){

        $solicitudes= Vacation::leftJoin('workers','vacations.worker_id','=','workers.id')
       ->leftJoin('statevacations','vacations.state_id','=','statevacations.id')
       ->where('worker_id', '=', $worker->id)
       ->select('vacations.id', 'vacations.date_init', 'vacations.date_end', 'vacations.days_taken' ,'workers.name', 'statevacations.name as descricion_estado' )->get();

       $datos = $worker->toArray();

      }else{
        $solicitudes=null;
        $datos=null;
      }
       
      //  $datos = $worker->toArray();

       // dd( $solicitudes);

        $vacaciones = new VacationController;
        if ($datos) {
            $result = $vacaciones->calcular_dias($datos['date_in']);
        } else {
            $result = null;
        }
        return view('worker.infoVacation')
            ->with('worker', $worker)
            ->with('result', $result)
            ->with('datosUser', $datosUser)
            ->with('items', $solicitudes);
    }
}
