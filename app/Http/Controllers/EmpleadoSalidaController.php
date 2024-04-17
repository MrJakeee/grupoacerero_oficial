<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoSalidaController extends Controller
{
    public function registrarSalida(Request $request)
    {
        $datos_empleado_salida = $this->obtenerDatosEmpleado($request);

        //Aqui tengo que realizar una funcion para obtener los informes que esten activos
        $this->informesActivosEntrada($request);
        $informe_entrada = $request->session()->get('informeEntrada');


        return view("Empleados.Salida.Empleado_salida")->with(['datos_empleado_salida' => $datos_empleado_salida,
            'informeEntrada' => $informe_entrada]);
    }

    public function informesActivosEntrada(Request $request)
    {
        $request->session()->remove('informeEntrada');
        try {
            $sql_informes = DB::select("SELECT * FROM informes JOIN proovedores ON informes.id_proovedor = proovedores.id_proovedor WHERE status = true;");
            if (!empty($sql_informes)){
                $request->session()->put('informeEntrada', $sql_informes);
            }
        }catch (\Throwable $throwable){
            return view("Empleado.Entrada.Empleado_entrada")->with("Incorrecto", "Surgio el siguiente problema ". $throwable);
        }

    }

    public function solicitarDatosSalida(Request $request, $id)
    {
        try {
            $empleado_salida = $this->obtenerDatosEmpleado($request);
            $datos_proovedor_salida = DB::select("SELECT * FROM Proovedores WHERE id_proovedor = ?",[
                $id
            ]);

            if (!empty($empleado_salida) && !empty($datos_proovedor_salida)){
                return view("Empleados.Salida.Empleado_salida_mostrarDatos")->with(['empleado_salida' => $empleado_salida,
                    'datos_proovedor_salida' => $datos_proovedor_salida]);
            }else{
                return redirect()->route("registrar.salida")->with([
                    'incorrecto' => "Ha sucedido algún problema",
                    'datos_empleado_entrada' => $empleado_salida,
                    'informeEntrada' => session()->get('informeEntrada'),
                ]);
            }
        }catch (\Throwable $throwable){
            return redirect()->route("registrar.salida")->with([
                'incorrecto' => "Ha sucedido algún problema" . $throwable
            ]);
        }
    }

    public function enviarDatosSalida(Request $request)
    {

        try {
            $datos_proovedor = $request->id_proovedor;
            if (!empty($datos_proovedor)){
                $actualizar_informe = DB::update("UPDATE informes SET status = false, hora_salida = CURRENT_TIMESTAMP WHERE id_proovedor = (?) AND status = true",[
                    $datos_proovedor
                ]);
                if (!empty($actualizar_informe)){
                    return redirect()->route("registrar.salida")->with('correcto', "Se ha registrado correctamente la salida");
                }else{
                    return redirect()->route("registrar.salida")->with('incorrecto', "No se ha registrado correctamente la salida");
                }
            }else{
                return redirect()->route('registrar.salida')->with('incorrecto', "Datos no recoleccionados correctamente");
            }
        }catch (\Throwable $throwable){
            return redirect()->route('registrar.salida')->with('incorrecto', "Ha sucedido un error al solicitar los datos");
        }

    }

    public function obtenerDatosEmpleado(Request $request)
    {
        return $request->session()->get('datos_empleado_salida');
    }

}
