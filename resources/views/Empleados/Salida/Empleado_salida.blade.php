@extends("diseñoGeneral.contenedor_principal")

@section("usuario")

    @foreach($datos_empleado_salida as $item_empleado_salida)
        <p>{{$item_empleado_salida->nombre_empleado}}</p>
    @endforeach

@endsection

@section("contenedor")
    <div style="height: 77.7vh" class="justify-content-center text-center">
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
            }

            document.getElementById('submit').addEventListener('click', function(){
                document.getElementById('prueba').style.visibility = 'visible';
            })


            function escaneoFallido(err){
                console.log(err)
            }
        </script>
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


