<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedoresController extends Controller
{
    public function index(Request $request)
    {
        $datos_admin = $request->session()->get("datos_empleado_administrador");

        try{
            $datos_proveedor = DB::select("SELECT * FROM proovedores;");
            if (!empty($datos_proveedor)){
                return view("Empleados.Administrador.Proveedores.proveedor")->with(['datos_admin' => $datos_admin, 'datos_proveedor' => $datos_proveedor]);
            }else{
                return redirect()->route("administrador.index")->with('incorrecto', "Algo ha salido mal");
            }
        }catch (\Throwable $throwable){
            return redirect()->route("administrador.index")->with('incorrecto', "Algo ha salido mal" . $throwable);
        }
    }

    public function update(Request $request)
    {
        try{
            $sql_update = DB::update("UPDATE proovedores SET nombre_proovedor = (?), email_proovedor = (?), descripcion_proovedor = (?) WHERE id_proovedor = ($request->id_proveedor);",
                [
                    $request->nombre_proveedor,
                    $request->email_proveedor,
                    $request->desc_proveedor
                ]);

            if (!empty($sql_update)){
                return redirect()->route("proveedores.index")->with("correcto", "Se ha modificado correctamente la informacion del proveedor");
            }else{
                return redirect()->route("proveedores.index")->with('incorrecto', 'No se ha modificado correctamente la informacion del proveedor');
            }
        }catch (\Throwable $throwable){
            return redirect()->route("proveedores.index")->with('incorrecto', 'No se ha modificado correctamente la informacion del proveedor');
        }
    }

    public function add(Request $request)
    {
        try{

            $sql_add = DB::insert("INSERT INTO proovedores (nombre_proovedor, email_proovedor, descripcion_proovedor) VALUES ((?),(?),(?));",[
                $request->nombre_proveedor,
                $request->email_proveedor,
                $request->desc_proveedor
            ]);

            if (!empty($sql_add)){
                return redirect()->route("proveedores.index")->with("correcto", "Se ha registrado correctamente");
            }else{
                return redirect()->route("proveedores.index")->with('incorrecto', 'No se registro correctamente el proveedor');
            }
        }catch (\Throwable $throwable){
            return redirect()->route("proveedores.index")->with('incorrecto', 'No se registro correctamente el proveedor' .$throwable);
        }
    }
}
