<!--formulario de creacion de empleado
lo ultimo es para subir la foto-->
@extends('layouts.app')
@section('content')
<div class="container"><form action= "{{url('/empleado')}}" method="post" enctype="multipart/form-data"> 
  <!--token de seguridad-->
    @csrf
    @include('empleado.form',['modo'=>'Guardar'])


</form>
</div>
@endsection
