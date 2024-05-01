@extends('diseñoGeneral.contenedor_principal')

@section('usuario')
    @foreach($datos_admin as $item)
        <p>{{$item->nombre_empleado}}</p>
    @endforeach
@endsection

@section("usuario_info_extra")

    <a class="usuario_info_extra" href="{{route("bienvenida.index")}}">Cerrar Session</a>

@endsection

@section("usuario_cambiar_ventana")
    <a class="usuario_info_extra" href="{{route("administrador.index")}}">Regresar</a>
@endsection


@section('contenedor')

    <div style="height: 77.7vh">
        <div class="table_container table-responsive p-4" style="max-height: 700px; overflow-y: auto">
            <table class="table table-hover text-center">
                <h1 class="text-center">Proveedores</h1>
                <div class="text-center p-5">
                    <form action="" >
                        <a href="" data-bs-toggle="modal" data-bs-target="#modalAgregar" class="btn-custom bg-orange clear_a">Agregar Proveedor</a>
                    </form>
                </div>

                <thead>
                <tr>
                    <th scope="col">Id empleado</th>
                    <th scope="col">Nombre empleado</th>
                    <th scope="col">Domicilio</th>
                    <th scope="col">Colonia</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($datos_proveedor as $item_proveedor)
                    <tr>
                        <th>{{$item_proveedor->id_proovedor}}</th>
                        <td>{{$item_proveedor->nombre_proovedor}}</td>
                        <td>{{$item_proveedor->email_proovedor}}</td>
                        <td>{{$item_proveedor->descripcion_proovedor}}</td>
                        <td class="">
                            <a href=""  data-bs-toggle="modal" data-bs-target="#modalEditar{{$item_proveedor->id_proovedor}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#modalQR{{$item_proveedor->id_proovedor}}" class="btn btn-success btn-sm"><i class="fa-solid fa-qrcode"></i></a>
                        </td>


                        <!--Modal modificar proveedores-->
                        <div class="modal fade" id="modalEditar{{$item_proveedor->id_proovedor}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar datos de producto</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route("proveedores.update")}}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="id" class="form-label">Id Proveedor</label>
                                                <input type="text" class="form-control" name="id_proveedor" value="{{$item_proveedor->id_proovedor}}"
                                                       readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre proveedor</label>
                                                <input type="text" class="form-control" name="nombre_proveedor" value="{{$item_proveedor->nombre_proovedor}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="domicilio" class="form-label">Email del proveedor</label>
                                                <input type="text" class="form-control" name="email_proveedor"  value="{{$item_proveedor->email_proovedor}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="colonia" class="form-label">Descripcion del proveedor</label>
                                                <input type="text" class="form-control" name="desc_proveedor"  value="{{$item_proveedor->descripcion_proovedor}}">
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
                        <!--Final de modal modificar empleados-->



                        <!--Modal para generar codigoqr-->
                        <div class="modal fade" id="modalQR{{$item_proveedor->id_proovedor}}" tabindex="-1" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="">Modificar datos de producto</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="id" class="form-label">Id Proveedor</label>
                                                <input type="text" class="form-control TextoQR" name="id_proveedor" value="{{$item_proveedor->id_proovedor}}"
                                                       readonly>
                                                <div class="CodigoQR" style="margin-top: 20px; margin-bottom: 20px;"></div>
                                                <h2 class="mensajeError" style="display: none;"></h2>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button class="btn btn-primary DescargarQR">Descargar QR</button>
                                                <button type="submit" class="btn btn-primary GenerarQR">Generar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Final de modal generar codigoqr-->




                    </tr>
                @endforeach


                <!-- Modal de registrar proveedores-->

                <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="AgregarEmpleados" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="AgregarEmpleados">Agregar Empleado</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route("proveedores.add")}}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre proveedor</label>
                                        <input type="text" class="form-control" name="nombre_proveedor" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="Email" class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email_proveedor"  >
                                    </div>
                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label">Descripcion proveedor</label>
                                        <input type="text" class="form-control" name="desc_proveedor" >
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Fin de modal de registro de empleados-->




                </tbody>
            </table>
        </div>
        <script src="https://kit.fontawesome.com/d4a37425ae.js" crossorigin="anonymous"></script>
        <script src="{{asset("../node_modules/qrcodejs/qrcode.js")}}"></script>
        <script src="{{asset("../resources/js/generarQR.js")}}"></script>
    </div>

@endsection



@section("mensajes_sistema")
    @if(session('correcto'))
        <h2 id="validated_message" style="color: white">{{session('correcto')}}</h2>
    @elseif(session('incorrecto'))
        <h2 id="error_message" style="color: red">{{session('incorrecto')}}</h2>
    @endif
@endsection