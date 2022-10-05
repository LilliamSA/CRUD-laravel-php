<h1> {{$modo}} empleados</h1> 
@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        <!--recorrer la lista de errores-->
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" name="nombre" value= "{{isset($empleado->Nombre) ? $empleado->Nombre:old('nombre')}}" id="nombre" placeholder="Nombre">
    </div>
    <div class="form-group">
    <label for="apellido1">Primer Apellido</label>
    <input type="text" class="form-control" name="Apellido1" value= "{{isset($empleado->Apellido1)? $empleado->Apellido1:old('Apellido1')}}" id="Apellido1" placeholder="Primer apellido">
    </div>
    <div class="form-group">
    <label for="apellido1">Segundo Apellido</label>
    <input type="text" class="form-control" name="Apellido2" value= "{{isset($empleado->Apellido2)?$empleado->Apellido2:old('Apellido2')}}" id="Apellido2" placeholder="Segundo apellido">
    </div>
    <div class="form-group">
    <label for="correo">Correo</label>
    <input type="text" class="form-control" name="correo" value= "{{isset($empleado->correo)?$empleado->correo:old('correo')}}" id="correo" placeholder="Correo">
    </div>
    <div class="form-group">
    <label for="foto"></label>
    @if (isset($empleado->foto))
    <img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$empleado->foto}}" alt="" width="100">
    @endif
    </div>
    <div class="form-group">
    <input type="file" class="form-control" name="foto" value= " " id="foto" placeholder="Foto">
    <br>
    </div>
    <input class="btn btn-success" type="submit" cla value="{{$modo}} datos"> 
    <!--boton para regresar-->
    <a class="btn btn-primary" href="{{url('empleado')}}">Regresar</a>
<br>

    
