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

    <div>
        <form class="text-center m-5 p-1" action="">
            <label for="fecha_y_hora">Buscar por una fecha y hora:</label>
            <input type="datetime-local" id="fecha_y_hora" name="fecha_y_hora">
            <button type="submit">Buscar</button>
        </form>

        <div class="table_container table-responsive p-4 m-2" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-hover text-center">
                <h1 class="text-center">Tabla de Proovedores</h1>
                <thead>
                    <tr>
                        <th scope="col">ID_Informe</th>
                        <th scope="col">Hora Entrada</th>
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
                            <td class="">
                                <a href="{{ route('administrador.pdf', $item_informes->id_informe) }}" class="btn btn-warning btn-sm"><i class="fa-regular fa-file-pdf"></i></a>
                                <a href=""  class="btn btn-warning btn-sm"><i class="fa-regular fa-file-excel"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/d4a37425ae.js" crossorigin="anonymous"></script>
@endsection
