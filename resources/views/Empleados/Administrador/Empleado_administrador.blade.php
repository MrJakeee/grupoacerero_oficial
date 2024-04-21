@extends('diseñoGeneral.contenedor_principal')

@section('usuario')
    @foreach($datos_admin as $item)
        <p>{{$item->nombre_empleado}}</p>
    @endforeach
@endsection

@section('usuario_info_extra')
    <a class="usuario_info_extra" href="{{route("bienvenida.index")}}">Cerrar Session</a>
@endsection

@section('contenedor')

    <div class="m-5 p-1">
        <div class="d-flex justify-content-around m-5">
            <button class="btn-custom bg-orange">Ver Empleados</button>
            <button class="btn-custom bg-orange">Ver Proovedores</button>
        </div>
    </div>

@endsection


@section('contendor_bajo')

    <div style="height: 52vh">
        <form class="text-center m-5 p-1" action="{{route("administrador.bs.informe")}}" method="get">
            <label for="fecha_y_hora">Buscar por fecha de entrada</label>
            <input type="date" id="fecha" name="fecha">
            <button type="submit">Buscar</button>
        </form>

        <div class="table_container table-responsive p-4 m-2" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-hover text-center">
                <h1 class="text-center">Tabla de Proovedores</h1>
                <thead>
                    <tr>
                        <th scope="col">ID_Informe</th>
                        <th scope="col">Hora Entrada</th>
                        <th scope="col">Hora Salida</th>
                        <th scope="col">Nombre Proovedor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($informes as $item_informes)
                        <tr>
                            <th>{{$item_informes->id_informe}}</th>
                            <td>{{$item_informes->hora_entrada}}</td>
                            <td>{{$item_informes->hora_salida}}</td>
                            <td>{{$item_informes->nombre_proovedor}}</td>
                            <td class="">
                                <a href="{{ route('administrador.pdf', $item_informes->id_informe) }}" class="btn btn-warning btn-sm"><i class="fa-regular fa-file-pdf"></i></a>
                                <a href="{{route('administrador.excel', $item_informes->id_informe )}}"  class="btn btn-warning btn-sm"><i class="fa-regular fa-file-excel"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/d4a37425ae.js" crossorigin="anonymous"></script>
@endsection


@section("mensajes_sistema")
    @if(session('correcto'))
        <h2 id="validated_message" style="color: white">{{session('correcto')}}</h2>
    @elseif(session('incorrecto'))
        <h2 id="error_message" style="color: red">{{session('incorrecto')}}</h2>
    @endif
@endsection
