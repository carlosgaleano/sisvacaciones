@extends('layouts.app')
{{$workers}}
@section('content')
<div class="container">
<div class="panel panel-default">
  <div class="panel-body">Vacaciones Fecha de Ingreso: {{$workers->date_in}} </div>
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
  <div class="panel-body">Vacaciones Tomadas</div>
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
    <tr>
      <th scope="row"></th>
      <td></td>
      <td></td>
      <td></td>
    </tr>
   
  </tbody>
</table>


  </div>
</div>

</div>
@endsection