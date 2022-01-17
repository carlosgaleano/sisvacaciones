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
      <td>{{$item->descricion_estado}}</td>
      <td>
                                    <!-- Single button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                           <li><a href="#" data-toggle="modal" data-target="#modalWorker">Aprobar Vacaciones</a></li>
<!--                                            <li><a href="{{ url('/worker/show/'.Crypt::encrypt($item->id)) }}">Informacion de {{$item->id}}</a></li>
 -->                                        </ul>
                                    </div>
                                </td>

    </tr>
   
    <div class="modal fade" tabindex="-1" role="dialog" id="modalWorker">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Aprobación de vacaciones</h4>
            </div>
            <form role="form" method="POST" action="{{ url('/worker/remove') }}">
                {!! csrf_field() !!}
            <div class="modal-body">

                          
                    <div class="form-group">
                    <label class="col-md-2 control-label">Accion:</label>
                   

                      <div class="col-md-10">
                          {!! Form::select('id_state',['' => 'Seleccione un Usuario...']+$estados,null, array('class' => 'form-control')) !!}

                          @if ($errors->has('id_state'))
                          <span class="help-block">
                              <strong>{{ $errors->first('id_state') }}</strong>
                          </span>
                          @endif
                      </div>
             
                    </div>
                             
                           


                   
                    <div class="form-group mt-4">
                        <label for="message-text" class="control-label">Observacion de la aprobacion:</label>
                        <textarea class="form-control" id="message-text" name="motivo_retiro"></textarea>
                    </div>
                    <input type="hidden" name="id_worker" value="{{$item->id}}"/>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Retirar Trabajador</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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