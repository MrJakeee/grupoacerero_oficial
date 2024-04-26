<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadosController extends Controller
{
    public function index(Request $request)
    {

        $datos_admin = $request->session()->get("datos_empleado_administrador");

        //peticion sql para obtener datos de todos los empleados

        try{
            $cargos = DB::select("SELECT * FROM cargo");

            $empleados_sql = DB::select("SELECT e.id_empleado, e.nombre_empleado, e.domicilio_empleado, c.nombre_cargo, e.colonia_empleado, c.id_cargo
                                                FROM empleados e
                                                JOIN grupoacerero_oficial.cargo c ON e.id_cargo = c.id_cargo;");


            if (!empty($empleados_sql && !empty($cargos))){
                return view("Empleados.Administrador.Empleados.empleados")->with(['datos_admin' => $datos_admin, 'datos_empleados' => $empleados_sql,
                    'cargos' => $cargos]);
            }else{
                return redirect()->route("empleados.index")->with('incorrecto', "Algo ha salido mal con la peticion");
            }
        }catch (\Throwable $throwable){
            return redirect()->route("empleados.index")->with('incorrecto', "Algo ha salido mal" .$throwable);
        }
    }


    public function update(Request $request)
    {
        try{
            $sql = DB::update("UPDATE empleados SET nombre_empleado = (?), domicilio_empleado = (?), colonia_empleado = (?), id_cargo = (?) WHERE id_empleado = $request->id_empleado;", [
                                                    $request->nombre_empleado,
                                                    $request->domiclio_empleado,
                                                    $request->colonia_empleado,
                                                    $request->cargo_empleado
            ]);

            if (!empty($sql)){
                return redirect()->route("empleados.index")->with('correcto', 'Se ha modificado correctamente la informacion del empleado');
            }else{
                return redirect()->route("empleados.index")->with('incorrecto', 'No se ha modificado correctamente la informacion del empleado');
            }
        }catch (\Throwable $throwable){
            return redirect()->route("empleados.index")->with('incorrecto', "Algo ha salido mal" . $throwable);
        }
    }

    public function delete($id)
    {
        try{
            $sql = DB::delete("DELETE FROM empleados WHERE id_empleado = (?)", [
                $id
            ]);

            if (!empty($sql)){
                return redirect()->route("empleados.index")->with('correcto', 'Se ha eliminado correctamente la informacion del empleado');
            }else{
                return redirect()->route("empleados.index")->with('incorrecto', 'No se ha eliminado correctamente la informacion del empleado');
            }
        }catch (\Throwable $throwable){
            return redirect()->route("empleados.index")->with('incorrecto', "Algo ha salido mal" . $throwable);
        }
    }
}
