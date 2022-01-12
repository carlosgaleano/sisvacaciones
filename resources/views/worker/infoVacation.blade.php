@extends('layouts.app')

@section('content')
<div class="container">
<div class="panel panel-default">
  <div class="panel-body">Vacaciones</div>
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
      <td>30</td>
    </tr>
    <tr>
      <th scope="row">(-) Tomadas</th>
      <td>30</td>
    </tr>
    <tr>
      <th scope="row">(=) Totales</th>
      <td>30</td>
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
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>


  </div>
</div>

</div>
@endsection