<?php

use App\Http\Controllers\EmpleadoAdministrador;
use App\Http\Controllers\EmpleadoEntradaController;
use App\Http\Controllers\EmpleadoSalidaController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\LoginEmpleadosController;
use Illuminate\Support\Facades\Route;


Route::get("/", [indexController::class, "index"])->name("bienvenida.index");

Route::get("/realizar-login", [LoginEmpleadosController::class, "realizarLogin"])->name("realizar.login");

Route::get("/registrar-entrada", [EmpleadoEntradaController::class, "registrarEntrada"])->name("registrar.entrada");
Route::get("/registrar-entrada-solicitud/{id}", [EmpleadoEntradaController::class, "solicitarDatos"])->name("registrar.solicitud");
Route::post("/registrar-entrada-proovedor", [EmpleadoEntradaController::class, "enviarDatos"])->name("enviar.datos");


Route::get("/registrar-salida", [EmpleadoSalidaController::class, "registrarSalida"])->name("registrar.salida");
Route::get("/registrar-salida-solicitud/{id}", [EmpleadoSalidaController::class, "solicitarDatosSalida"])->name("registrar.datos.salida");
Route::post("/registrar-salida-proovedor", [EmpleadoSalidaController::class, "enviarDatosSalida"])->name("enviar.datos.salida");

Route::get("/administrador", [EmpleadoAdministrador::class, "index"])->name("administrador.index");
Route::get("/administrador/pdf-{id}", [EmpleadoAdministrador::class, "pdf"])->name("administrador.pdf");
