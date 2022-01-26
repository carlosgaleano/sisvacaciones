<?php
/**
 * Created by PhpStorm.
 * User: marcelo
 * Date: 25-03-16
 * Time: 07:42 PM
 */

namespace App\Helpers;
use App\Vacation;
use App\Worker;
use App\StateVacations;
use App\User;
use DateTime;

class MyHelper {
    public static function vacationDays($date){
        $date_current = new \DateTime();
        $date_init =  new \DateTime($date);
        $difference = $date_current->diff($date_init);
        $year_difference = $difference->format('%y');
        $vacation_days = 0;
        if($year_difference <= 5){
            $vacation_days = $year_difference*15;
        }elseif($year_difference > 5 && $year_difference <= 10){
            $vacation_days = 75+($year_difference-5)*20;
        }elseif($year_difference > 10){
            $vacation_days = 75+100+($year_difference-10)*30;
        }
        return $vacation_days;
    }

    public static function vacationDays2($inicio){
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

    public static function vacationTaken($id){
        $days_taken = Vacation::where('worker_id',$id)->sum('days_taken');
        return $days_taken;
    }

    public static function stateWorker($state){
        return ($state == 1)? 'ACTIVO' : 'RETIRADO';
    }


    public static function getIdUser(){

        $datos=User::select('id', 'name')
            ->whereNotIn('id', Worker::select('user_id as id')->get()->toArray())
            ->where('rol', '!=', 'admin')
            ->orderBy('id', 'ASC')
            ->first()->toArray();
        return $datos['id'];
    }
} 