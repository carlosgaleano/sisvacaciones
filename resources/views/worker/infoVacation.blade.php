@extends('layouts.app')



@section('content')
<div class="container">
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
      <td>0</td>
    </tr>
    <tr>
      <th scope="row">(=) Totales</th>
      <td>{{$result}}</td>
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
  @foreach ($items as $item)
    <p>This is user {{  $item }}</p>
    <tr>
      <th scope="row"></th>
      <td>1</td>
      <td></td>
      <td></td>
    </tr>
   
@endforeach
    
  </tbody>
</table>


  </div>
</div>

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