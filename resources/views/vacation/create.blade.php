@extends('layouts.app')
{{$dias_disponibles}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar vacacion a {{$name_worker}}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/vacation/store') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Tipo:</label>

                            <div class="col-md-6">
                                {!! Form::select('type',['' => 'Seleccione un tipo...','vacacion' => 'Vacacion','falta' => 'Falta','permiso' => 'Permiso'],null, array('class' => 'form-control')) !!}

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Razon:</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="reason" rows="5" id="reason" value="{{ old('reason') }}"></textarea>
                                @if ($errors->has('reason'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reason') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('days_taken') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Dias Tomados:</label>

                            <div class="col-md-6">
                                <input type="text" readonly class="form-control" id="days_taken" name="days_taken" value="{{ old('days_taken') }}">

                                @if ($errors->has('days_taken'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('days_taken') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date_init') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Fecha de Inicio:</label>

                            <div class="col-md-6">
                                <input onblur="validarfechas()"  type="text" class="form-control" id="date-init" name="date_init" value="{{ old('date_init') }}">

                                @if ($errors->has('date_init'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_init') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('date_end') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Fecha de Fin:</label>

                            <div class="col-md-6">
                                <input onblur="validarfechas()" type="text" class="form-control" id="date-end" name="date_end" value="{{ old('fecha_end') }}">

                                @if ($errors->has('fecha_end'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_end') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('observations') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Observations:</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="observations" rows="5" id="observations" value="{{ old('observations') }}"></textarea>
                                @if ($errors->has('observations'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('observations') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="worker_id" value="{{$id_worker}}"/>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar Vacacion
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('style')
{!! Html::style('css/bootstrap-datepicker3.css') !!}
@endsection
@section('javascript')
{!! Html::script('js/bootstrap-datepicker.min1.6.js') !!}
{!! Html::script('js/bootstrap-datepicker.es.min.js') !!}
{!! Html::script('js/moment.min.js') !!}
{!! Html::script('js/bootstrap-datetimepicker.min.js') !!}
<script>

    $( document ).ready(function() {
        console.log( "ready!" )

    });

    $('#date-init').datepicker({
        format: 'dd-mm-yyyy',
            language: 'es'
    });
    $('#date-end').datepicker({
        format: 'dd-mm-yyyy',
            language: 'es'
    });

    function validarfechas(){

     const fechaInicio=$('#date-init').val();
     const fechaEnd=$('#date-end').val();
     console.log('fecha inicio',fechaInicio, 'fecha fin',fechaEnd);
     
     const dias= getBusinessDatesCount(fechaInicio, fechaEnd);
     console.log('dias',dias);

  
};

function stringToDate(dateString){
        dateString = dateString.split('-');
        return new Date(dateString[0], dateString[1] - 1, dateString[2]);
    }

     
   //  count Work Day
   // calculo de dias laborales entre dos fechas
   
   function getBusinessDatesCount(fechaInicio, fechaFin) {
    let count = 0;
    var fechaInicio = moment(fechaInicio, "DD-MM-YYYY");
    var fechaFin = moment(fechaFin, "DD-MM-YYYY");
    var startDate = new Date(fechaInicio);
    var endDate = new Date(fechaFin);
  
    const hoy=new Date();
    const curDate = new Date(startDate.getTime());

   
    while (curDate <= endDate) {
        const dayOfWeek = curDate.getDay();
        if(dayOfWeek !== 0 && dayOfWeek !== 6) count++;
        curDate.setDate(curDate.getDate() + 1);
    }

    if( hoy > startDate ){
        alert('La fecha de inicio no puede ser mayor a la fecha actual');
        $('#date-init').val('');
        return false;
    }

    if(({{$dias_disponibles}}-count)<0){
        alert('No puede tomar mas dias de los que tiene disponibles, los dias de vacaciones disponibles son: '+{{$dias_disponibles}});
        $('#date-init').val('');
        $('#date-end').val('');
        
        return false;
    }

    if(startDate  > endDate){
        alert('La fecha de inicio no puede ser mayor a la fecha de fin');
        $('#date-init').val('');
        $('#date-end').val('');
        return false;
    }
    //alert({{$dias_disponibles}});
  $('#days_taken').val(count);
   // alert(count);
    return count;
}
  

  function validarperiodo(fechaInicio, fechaFin) {

    var fechaInicio = moment(fechaInicio, "DD-MM-YYYY");
    var fechaFin = moment(fechaFin, "DD-MM-YYYY");
    var fechaInicio = new Date(fechaInicio);
    var fechaFin = new Date(fechaFin);
    console.log('fecha inicio',fechaInicio, 'fecha fin',fechaFin);
    var diferencia = fechaFin.getTime() - fechaInicio.getTime();
    var dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
    return dias;
  }

</script>
@endsection