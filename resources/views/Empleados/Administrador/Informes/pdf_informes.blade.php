@extends("diseñoGeneral.contenedor_principal")z


@section("contenedor")

    <h1 class="text-center">{{$title}}</h1>
    <h1 class="text-center">Numero de reporte: {{$informes[0]->id_informe}}</h1>
    <div>
        <h2>Datos de proovedor</h2>
        <p>Id del proovedor: <b>{{$informes[0]->id_proovedor}}</b></p>
        <p>Nombre del proovedor: <b>{{$informes[0]->nombre_proovedor}}</b></p>
        <p>Hora de llegada: <b>{{$informes[0]->hora_entrada}}</b></p>
        <p>Hora de salida: <b>{{$informes[0]->hora_salida}}</b></p>
        <p>Descripcion: <b>{{$informes[0]->descripcion_proovedor}}</b></p>
    </div>
    <div>
        <h2>Datos del empleado que realizo el acceso</h2>
        <p>Id del empleado: <b>{{$informes[0]->id_empleado}}</b></p>
        <p>Nombre del empleado: <b>{{$informes[0]->nombre_empleado}}</b></p>
    </div>
@endsection

