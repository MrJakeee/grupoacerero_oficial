<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoEntradaController extends Controller
{

    public function registrarEntrada(Request $request)
    {
        $datos_empleado_entrada = $this->obtenerDatosEmpleado($request);
        return view("Empleados.Entrada.Empleado_entrada")->with(['datos_empleado_entrada' => $datos_empleado_entrada]);
    }

    public function solicitarDatos(Request $request, $id)
    {
        try {
            $empleado_entrada = $this->obtenerDatosEmpleado($request);
            $datos_proovedor = DB::select("SELECT * FROM Proovedores WHERE id_proovedor = ?",[
                $id
            ]);

            if (!empty($empleado_entrada) && !empty($datos_proovedor)){
                return view("Empleados.Entrada.Empleado_entrada_mostrarDatos")->with(['empleado_entrada' => $empleado_entrada,
                    'datos_proovedor' => $datos_proovedor]);
            }else{
                return view("Empleados.Entrada.Empleado_entrada")->with('incorrecto', "No se pudieron solicitar los datos del servidor");
            }
        }catch (\Throwable $throwable){
            return view("Empleado.Entrada.Empleado_entrada")->with("Incorrecto", "Surgio el siguiente problema ". $throwable);
        }
    }

    public function obtenerDatosEmpleado(Request $request)
    {
        return $request->session()->get('datos_empleado_entrada');
    }

    public function enviarDatos(Request $request)
    {
        try {
            $dato_id_proovedor = $request->id_proovedor;
            $dato_id_empleado = $request->id_empleado;

            if (!empty($dato_id_proovedor) && !empty($dato_id_empleado)){
                $sql_insert_informe = DB::insert("INSERT INTO informes(hora_salida, status, id_empleado, id_proovedor) VALUES (NULL, 0, (?), (?))", [
                    $dato_id_empleado,
                    $dato_id_proovedor
                ]);
                if (!empty($sql_insert_informe)){
                    return redirect()->route('registrar.entrada')->with('correcto', "Se ha registrado correctamente");
                }else{
                    return redirect()->route("registrar.entrada")->with('incorrecto', "No se ha registrado correctamente");
                }
            }else{
                return redirect()->back()->with('incorrecto', "Algo ha salido mal con la recoleccion de datos");
            }
        }catch (\Throwable $throwable){
            return redirect()->back()->with('incorrecto', $throwable);
        }

    }
}
