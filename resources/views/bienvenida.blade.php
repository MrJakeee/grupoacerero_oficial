@extends("diseñoGeneral.contenedor_principal")

@section("usuario")

    <button type="button" class="btn-custom" data-bs-toggle="modal" data-bs-target="#ModalLogin">
        Ingresar
    </button>

    <!-- Inicio de Modal{Login}-->

    <!-- Modal -->
    <div class="modal fade" id="ModalLogin" tabindex="-1" aria-labelledby="ModalLogin" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-orange">
                    <h1 class="modal-title" id="exampleModalLabel">Iniciar Sesion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Llena todos los campos</p>
                    <!-- Inicio de formulario -->
                    <form method="get" action="{{route("realizar.login")}}">
                        @csrf
                        <div class="mb-3">
                            <label for="for_id_usuario" class="form-label">ID Empleado</label>
                            <input type="text" class="form-control" name="id_empleado">
                        </div>
                        <div class="mb-3">
                            <label for="password_empleado" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password_empleado">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn-custom">Login</button>
                        </div>
                    </form>
                    <!-- Fin de formulario -->
                </div>
            </div>
        </div>
    </div>
    <!-- Termino de Modal{Login}-->
@endsection

@section("contenedor")
    <div>
        <img class=" container_img" src="{{asset("home-grupoacerero-1b.jpg")}}" >
        <h1 class="title_img">Visíon, liderezgo, <br> innovación y crecimiento <br> continuo</h1>
    </div>
@endsection

@section("contendor_bajo")
    <div class="d-flex justify-content-around m-3 p-2">
        <div class="w-50">
            <h1 class="text-center">Vision</h1>
            <p class="text-center">Estaremos entre las empresas mexicanas más reconocidas por su alto valor económico,
                pasión en cuidado del mercado, crecimiento sostenido, decisiones sobre nuestra cadena de valor y de gestión
                asertivas y por el impacto positivo de nuestras prácticas sustentables y de contribución social.</p>
        </div>
        <div class="w-50">
            <h1 class="text-center">Mision</h1>
            <p class="text-center">El acero es nuestra pasión. La confiabilidad y la innovación nuestro compromiso.
                La sustentabilidad y rentabilidad nuestra obligación.</p>
        </div>
        <div class="w-50">
            <h1 class="text-center">Objetivo</h1>
            <p class="text-center">
                Consciente del cuidado del medio ambiente,
                respeta y cumple con las leyes y reglamentos correspondientes, promueve y fomenta su cuidado a través de
                diversas acciones, campañas y políticas, buscando como objetivo principal el crear un hábito del cuidado
                de nuestro entorno natural.
            </p>
        </div>
    </div>
@endsection


@section("mensajes_sistema")
    @if(session('correcto'))
        <h2>{{session('correcto')}}</h2>
    @endif

    @if(session('incorrecto'))
        <h2>{{session('incorrecto')}}</h2>
    @endif
@endsection


