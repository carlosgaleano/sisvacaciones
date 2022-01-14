@extends('layouts.app')


@section('content')
<div class="container">


<div class="panel panel-default">
  <div class="panel-body">Vacaciones por aprobar <span style="margin-left: 70%">


</span></div>

  <div class="panel-footer">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">inicio</th>
      <th scope="col">fin</th>
      <th scope="col">dias</th>
      <th scope="col">Estado</th>
      <th scope="col">Acciones</th>
    </tr> 
  </thead>
  <tbody>
  @foreach ($solicitudes as $item)
    
    <tr>
      <td>{{$item->id}}</td>
      <td>{{date('d m Y', strtotime($item->date_init))}}</td>
      <td>{{date('d m Y', strtotime($item->date_end))}}</td>
      <td>{{$item->days_taken}}</td>
      <td>{{$item->id}}</td>
      <td>{{$item->descricion_estado}}</td>

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