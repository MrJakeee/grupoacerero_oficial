<?php

use App\Http\Controllers\EmpleadoAdministradorController;
use App\Http\Controllers\EmpleadoEntradaController;
use App\Http\Controllers\EmpleadoSalidaController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\LoginEmpleadosController;
use App\Http\Controllers\ProveedoresController;
use Illuminate\Support\Facades\Route;


Route::get("/", [indexController::class, "index"])->name("bienvenida.index");

Route::get("/realizar-login", [LoginEmpleadosController::class, "realizarLogin"])->name("realizar.login");

Route::get("/registrar-entrada", [EmpleadoEntradaController::class, "registrarEntrada"])->name("registrar.entrada");
Route::get("/registrar-entrada-solicitud/{id}", [EmpleadoEntradaController::class, "solicitarDatos"])->name("registrar.solicitud");
Route::post("/registrar-entrada-proovedor", [EmpleadoEntradaController::class, "enviarDatos"])->name("enviar.datos");


Route::get("/registrar-salida", [EmpleadoSalidaController::class, "registrarSalida"])->name("registrar.salida");
Route::get("/registrar-salida-solicitud/{id}", [EmpleadoSalidaController::class, "solicitarDatosSalida"])->name("registrar.datos.salida");
Route::post("/registrar-salida-proovedor", [EmpleadoSalidaController::class, "enviarDatosSalida"])->name("enviar.datos.salida");

Route::get("/administrador", [EmpleadoAdministradorController::class, "index"])->name("administrador.index");
Route::get("/administrador/pdf-{id}", [EmpleadoAdministradorController::class, "pdf"])->name("administrador.pdf");
Route::get("/administrador/busqueda", [EmpleadoAdministradorController::class, "buscarInformePorFecha"])->name("administrador.bs.informe");
Route::get("/administrador/excel-{id}", [EmpleadoAdministradorController::class, "excel"])->name("administrador.excel");


Route::get("/empleados", [EmpleadosController::class, "index"])->name("empleados.index");
Route::post("/empleados/update", [EmpleadosController::class, "update"])->name("empleados.update");
Route::get("/empleados/delete-{id}", [EmpleadosController::class, "delete"])->name("empleados.delete");

Route::get("/proveedores", [ProveedoresController::class, "index"])->name("proveedores.index");

