@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Usuarios</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>rol</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <th scope="row">{{$usuario->id}}</th>
                            <td>{{$usuario->name}}</td>
                            <td>{{$usuario->rol}}</td>
                            <td>
                                <!-- Single button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Editar area {{$usuario->name}}</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection