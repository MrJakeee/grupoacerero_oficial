<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginEmpleadosController extends Controller
{
    public function realizarLogin(Request $request)
    {
        $peticion_login = DB::select("SELECT * FROM Empleados WHERE id_empleado = (?) AND pass_empleado = (?)",[
            $request->id_empleado,
            $request->password_empleado
        ]);

        if (!empty($peticion_login)){
            $peticion_cargo = DB::select("SELECT * FROM empleados JOIN cargo ON empleados.id_cargo = cargo.id_cargo WHERE id_empleado = (?)",[
                $peticion_login[0]->id_empleado
            ]);
            if (!empty($peticion_cargo)){
                switch ($peticion_cargo[0]->nombre_cargo){
                    case "Administrador":
                        $request->session()->put('datos_empleado_administrador', $peticion_cargo);
                        return redirect()->route("administrador.index");

                    case "E_Entrada":
                        $request->session()->put('datos_empleado_entrada', $peticion_cargo);
                        return redirect()->route("registrar.entrada");

                    case "E_Salida":
                        $request->session()->put('datos_empleado_salida', $peticion_cargo);
                        return redirect()->route('registrar.salida');
                }
            }
        }else{
            return back()->with('incorrecto', "No se encontro el valor");
        }
    }

}
