@extends("diseñoGeneral.contenedor_principal")


@section("usuario")

    @foreach($empleado_salida as $item_empleado)
        <p>{{$item_empleado->nombre_empleado}}</p>
    @endforeach

@endsection


@section("contenedor")

    <div style="height: 77.7vh">
        <form action="{{route("enviar.datos.salida")}}" method="post">
            @csrf
            <div class="p-4">
                @foreach($datos_proovedor_salida as $item_proovedor)
                    <div class="row m-2">
                        <h1>Datos del proovedor</h1>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="id_proovedor" readonly placeholder="{{$item_proovedor->id_proovedor}}"
                                   value="{{$item_proovedor->id_proovedor}}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="nombre_proovedor" readonly placeholder="{{$item_proovedor->nombre_proovedor}}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="email_proovedor" readonly placeholder="{{$item_proovedor->email_proovedor}}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="descripcion_proovedor" readonly placeholder="{{$item_proovedor->descripcion_proovedor}}">
                        </div>
                    </div>
                @endforeach

                <div class="row m-2 justify-content-center">
                    <h1 class="text-center">Datos del empleado</h1>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="id_empleado" readonly placeholder="{{$item_empleado->id_empleado}}"
                               value="{{$item_empleado->id_empleado}}">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="nombre_empleado" readonly placeholder="{{$item_empleado->nombre_empleado}}">
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn-custom bg-orange">Ingresar Datos</button>
            </div>

        </form>
    </div>

@endsection

@section("mensajes_sistema")
    <div class="p-2">
        @if(session('correcto'))
            <h2 style="color: white">{{session('correcto')}}</h2>
        @elseif(session('incorrecto'))
            <h2 style="color: red">{{session('incorrecto')}}</h2>
        @endif
    </div>
@endsection



