@extends('diseñoGeneral.contenedor_principal')

@section('usuario')
    @foreach($datos_admin as $item)
        <p>{{$item->nombre_empleado}}</p>
    @endforeach
@endsection



@section("contenedor")

    <div class="table_container table-responsive p-4 m-2" style="max-height: 400vh; overflow-y: auto;">
        <table class="table table-hover text-center">
            <h1 class="text-center">Empleados</h1>
            <div class="text-center p-5">
                <form action="" >
                    <button class="btn-custom bg-orange">Agregar Empleado</button>
                </form>
            </div>


            <!-- Modal de registro de empleados-->




            <thead>
                <tr>
                    <th scope="col">Id empleado</th>
                    <th scope="col">Nombre empleado</th>
                    <th scope="col">Domicilio</th>
                    <th scope="col">Colonia</th>
                    <th scope="col">Cargo</th>
                    <th></th>
                </tr>
            </thead>
                <tbody>
                @foreach($datos_empleados as $item_empleado)
                    <tr>
                        <th>{{$item_empleado->id_empleado}}</th>
                        <td>{{$item_empleado->nombre_empleado}}</td>
                        <td>{{$item_empleado->domicilio_empleado}}</td>
                        <td>{{$item_empleado->colonia_empleado}}</td>
                        <td>{{$item_empleado->nombre_cargo}}</td>
                        <td class="">
                            <a href=""  data-bs-toggle="modal" data-bs-target="#modalEditar{{$item_empleado->id_empleado}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{route("empleados.delete",$item_empleado->id_empleado)}}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                        </td>


                        <!--Moodal modificar empleados-->
                        <div class="modal fade" id="modalEditar{{$item_empleado->id_empleado}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar datos de producto</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route("empleados.update")}}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="id" class="form-label">Id Empleado</label>
                                                <input type="text" class="form-control" name="id_empleado" value="{{$item_empleado->id_empleado}}"
                                                       readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre empleado</label>
                                                <input type="text" class="form-control" name="nombre_empleado" value="{{$item_empleado->nombre_empleado}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="domicilio" class="form-label">Domicilio</label>
                                                <input type="text" class="form-control" name="domiclio_empleado"  value="{{$item_empleado->domicilio_empleado}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="colonia" class="form-label">Colonia</label>
                                                <input type="text" class="form-control" name="colonia_empleado"  value="{{$item_empleado->colonia_empleado}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="cargo" class="form-label">Cargo</label>
                                                <select class="form-control" name="cargo_empleado">
                                                    <option value="">Selecciona un cargo</option>
                                                    @foreach($cargos as $cargo)
                                                        <option value="{{$cargo->id_cargo}}" selected>{{$cargo->nombre_cargo}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Modificar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
                </tbody>
        </table>

        <script src="https://kit.fontawesome.com/d4a37425ae.js" crossorigin="anonymous"></script>

    </div>

@endsection


@section("mensajes_sistema")
    @if(session('correcto'))
        <h2 id="validated_message" style="color: white">{{session('correcto')}}</h2>
    @elseif(session('incorrecto'))
        <h2 id="error_message" style="color: red">{{session('incorrecto')}}</h2>
    @endif
@endsection