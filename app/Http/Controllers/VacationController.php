<?php

namespace App\Http\Controllers;

use App\Vacation;
use App\User;
use App\Worker;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use DateTime;


class VacationController extends Controller
{
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
        //
    }

    public function create($id_worker,$name_worker)
    {
        try {
            $decrypted_id = \Crypt::decrypt($id_worker);
            $decrypted_name = \Crypt::decrypt($name_worker);
        } catch (DecryptException $e) {
            return redirect('/home');
        }
       

          
        $worker=Worker::where('id','=',$decrypted_id)->first();

       // dd($id_worker);
        $datos = $worker->toArray();
       // $vacaciones = new VacationController;   
        $result =  $this->calcular_dias($datos['date_in']); 

        return view('vacation.create')->with('id_worker',$decrypted_id)
                                      ->with('name_worker',$decrypted_name)
                                      ->with('dias_disponibles',$result);
    }

    
     public function calcular_dias($inicio){

        //$inicio="2014-01-01 00:00:00";
        $fin=date('Y-m-d H:i:s');
         
        $datetime1=new DateTime($inicio);
        $datetime2=new DateTime($fin);
         
        # obtenemos la diferencia entre las dos fechas
        $interval=$datetime2->diff($datetime1);
         
        # obtenemos la diferencia en meses
        $intervalMeses=$interval->format("%m");
        # obtenemos la diferencia en años y la multiplicamos por 12 para tener los meses
        $intervalAnos = $interval->format("%y")*12;
        
        $dias=($intervalMeses+$intervalAnos)*1.25;
        return $dias;
        



     }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'days_taken' => 'required',
            'reason' => 'required',
            'observations' => 'required',
            'date_init' => 'required',
            'date_end' => 'required',
            'worker_id' => 'required',
        ]);

        $vacation = new Vacation();
        $vacation->type = $request['type'];
        $vacation->days_taken = $request['days_taken'];
        $vacation->reason = $request['reason'];
        $vacation->observations = $request['observations'];
        $vacation->date_init = date("Y-m-d", strtotime($request['date_init']));
        $vacation->date_end = date("Y-m-d", strtotime($request['date_end']));
        $vacation->worker_id = $request['worker_id'];

        $vacation->save();

        return redirect('/home');
    }
}