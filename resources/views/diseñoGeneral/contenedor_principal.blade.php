<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!--Links de css-->
    <link rel="stylesheet" href="{{asset("../resources/css/app.css")}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>


    <!--Creacion de navbar-->
    <div class="bg-orange">
        <nav class="navbar container">
            <div class="container-fluid">
                <img src="{{asset("elefantesincolor.png")}}" width="220px">
                <div class="text-center mt-3 justify-content-center" style="align-content: center; display: flex">
                    <span class="fw-bold-7 me-5 fs-5 ">@yield('usuario')</span>
                    <p class="fw-bold-7 me-5 fs-5">@yield('usuario_info_extra')</p>
                </div>
            </div>
        </nav>
    </div>

    <!--Creacion del contenedor-->

    <div>
        @yield("contenedor")
    </div>

    <div>
        @yield("contendor_bajo")
    </div>


    <!--Creacion del pie de pagina-->

    <footer class="footer bg-orange height-custom-footer">
        <div class="container">
            @yield('mensajes_sistema')
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
