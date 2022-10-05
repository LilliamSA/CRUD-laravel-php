@extends('layouts.app')
@section('content')
<div class="container">


 @if(Session::has('mensaje'))
 <div class="alert alert-success alert-dismissible" role="alert">
 {{Session::get('mensaje')}}
 <!--hacer un boton que me deje cerrar el mensaje con laravel 9-->
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- boton para agregar empleados-->
<a href="{{url('empleado/create')}}" class="btn btn-success">Agregar Empleado</a>
<br>
<br>
<table class="table table-white table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido1</th>
            <th>Apellido2</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <!--recorrer la lista de empleados y mostrarlos en la tabla -->
        @foreach($empleados as $empleado)
        <tr>
            <td>{{$empleado->id}}</td>
            <td>
                <img src="{{asset('storage').'/'.$empleado->foto}}" alt="" width="100">
            </td>
            <td>{{$empleado->Nombre}}</td>
            <td>{{$empleado->Apellido1}}</td>
            <td>{{$empleado->Apellido2}}</td>
            <td>{{$empleado->correo}}</td>
            <td>
                <a href="{{url('/empleado/'.$empleado->id.'/edit')}}" class="btn btn-warning">Editar</a>
                |
                <form action="{{url('/empleado/'.$empleado->id)}}" class="d-inline" method="post">
                    @csrf
                    <!--metodo para eliminar-->
                    {{method_field('DELETE')}}
                    <!--boton para eliminar y redirigir-->
                    <input class="btn btn-danger" type="submit" onclick="return confirm('¿Borrar?')" value="Borrar">

                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--para pasar de pagina-->
{!!$empleados->links()!!}
</div>
@endsection
