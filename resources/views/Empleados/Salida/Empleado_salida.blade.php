@extends("diseñoGeneral.contenedor_principal")

@section("usuario")
    @foreach($datos_empleado_salida as $item_empleado_salida)
        <p>{{$item_empleado_salida->nombre_empleado}}</p>
    @endforeach
@endsection

@section("usuario_info_extra")
    <a class="usuario_info_extra" href="{{route("bienvenida.index")}}">Cerrar Session</a>
@endsection


@section("contenedor")
    <div style="height: 300px" class="justify-content-center text-center">
        <h1 class="text-center">Leer códigos QR</h1>
        <div id="lectorQR"></div>
        <div id="resultadoQr"></div>


        <script src="{{asset("../node_modules/html5-qrcode/html5-qrcode.min.js")}}"></script>
        <script>

            const escanearQr = new Html5QrcodeScanner('lectorQR', {
                qrbox:{
                    width: 250,
                    height: 250,
                },
                fps: 20,
            })

            escanearQr.render(escaneoExitoso, escaneoFallido);

            function escaneoExitoso(resultado) {
                // Agregar el resultado al formulario

                const NumResultado = parseInt(resultado);

                if(!isNaN(NumResultado)){
                    var url = `{{ route('registrar.datos.salida', ':resultado') }}`;
                    url = url.replace(':resultado', resultado);

                    document.getElementById('resultadoQr').innerHTML = `
                <form id="formularioResultado" action="${url}" method="get">
                    <h1>Lectura Exitosa</h1>
                    <p name="codigoQR_proovedor">El resultado de la lectura es la siguiente: ${resultado}</p>
                    <button type="submit">Enviar resultado a Laravel</button>
                </form>
                `;
                    escanearQr.clear();
                    document.getElementById('lectorQr').remove();

                    // Enviar el formulario
                    document.getElementById('formularioResultado').submit();
                }else{
                    escanearQr.clear();

                    document.getElementById('resultadoQr').innerHTML = `
                        <h1 class="text-center">El valor ingresado puede ser que no este correctamente</h1>
                        <p class="text-center" >Debera de ingresar nuevamente el codigo qr</p>
                        <button type="submit" id="resetearQR">Resetear</button>
                    `

                    document.getElementById('resetearQR').addEventListener('click', () =>{
                        document.getElementById('resultadoQr').innerHTML = ''; // Limpiar el contenido del contenedor
                        escanearQr.render(escaneoExitoso, escaneoFallido); // Volver a renderizar el escáner
                    })
                }
            }


            function escaneoFallido(err){
                console.log(err)
            }
        </script>
    </div>

    <div style="height: 46vh">
        @if(session('informeEntrada'))
            <div class="table_container table-responsive p-4" style="max-height: 400px; overflow-y: auto">
                <table class="table table-hover text-center">
                    <h1 class="text-center">Tabla de Proovedores Dentro</h1>
                    <thead>
                    <tr>
                        <th scope="col">ID_Informe</th>
                        <th scope="col">Hora Entrada</th>
                        <th scope="col">Nombre Proovedor</th>
                        <th scope="col">Descripcion</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($informeEntrada as $item_informe)
                        <tr>
                            <th scope="row">{{$item_informe->id_informe}}</th>
                            <td>{{$item_informe->hora_entrada}}</td>
                            <td>{{$item_informe->nombre_proovedor}}</td>
                            <td>{{$item_informe->descripcion_proovedor}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
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


