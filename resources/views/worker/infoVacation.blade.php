@extends('layouts.app')


@section('content')
<div class="container">

@if($worker)


<div class="panel panel-default">

  <div class="panel-body">Vacaciones Fecha de Ingreso: {{$worker->date_in}} </div>
  <div class="panel-footer">

  <table class="table">
  <thead>
    <tr>
      <th class="col-md-10" scope="col">saldo</th>
      <th  class="col-md-2"  scope="col">legales</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">(+) Acumuladas</th>
      <td>{{$result}}</td>
    </tr>
    <tr>
      <th scope="row">(-) Tomadas</th>
      <td>{{$vacationTaken=MyHelper::vacationTaken($worker->id)}}</td>
    </tr>
    <tr>
      <th scope="row">(=) Totales</th>
      <td>{{$result -$vacationTaken}}</td>
    </tr>
   
  </tbody>
</table>

  </div>
</div>

<div class="panel panel-default">
  <div class="panel-body">Vacaciones Tomadas <span style="margin-left: 70%">
  <a class="btn btn-success" href="{{  url('/vacation/create/'.Crypt::encrypt($worker->id).'/'.Crypt::encrypt($worker->name))}}">Solicitar Vacaciones</a>

</span></div>

  <div class="panel-footer">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">inicio</th>
      <th scope="col">fin</th>
      <th scope="col">dias</th>
      <th scope="col">Estado</th>
    </tr>
  </thead>
  <tbody>
  @if($items)
  @foreach ($items as $item)
    
    <tr>
      <td>{{$item->date_init}}</td>
      <td>{{$item->date_end}}</td>
      <td>{{$item->days_taken}}</td>
      <td>{{$item->descricion_estado}}</td>
    </tr>
   
@endforeach
@endif
    
  </tbody>
</table>


  </div>
</div>

@else
<div class="panel panel-default">
  <div class ="panel-body info">
 <span class="info">El Usuario no tiene un trabajador associado </span>   
  </div>
  <div class=""></div>

@endif
</div>
@endsection
<script>
  function validarperiodo(fechaInicio, fechaFin) {
    var fechaInicio = new Date(fechaInicio);
    var fechaFin = new Date(fechaFin);
    var diferencia = fechaFin.getTime() - fechaInicio.getTime();
    var dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
    return dias;
  }
</script>
<style>
  
  .info{
text-align: center;
color: midnightblue;
font-size: 20px;
  }
</style>