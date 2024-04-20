<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use Barryvdh\DomPDF\Facade\Pdf;

class EmpleadoAdministrador extends Controller
{
    public function index(Request $request)
    {
        //Obtener datos del empleado con rango administrador
        $datos_empleado_administrador = $request->session()->get('datos_empleado_administrador');

        //SQL para poder obtener todos los informes

        $sql_informes = DB::select("SELECT * FROM informes WHERE status = false");


        //Compruebo si el SQL funciona correctamente
        if (!empty($sql_informes)){
            //Ingreso como una Session los informes
            $request->session()->put('informe', $sql_informes);

            //Regreso a la vista
            return view("Empleados.Administrador.Empleado_administrador")->with(['datos_admin' => $datos_empleado_administrador,
                'informes' => $sql_informes]);
        }else{
            //Regreso a la vista con mensaje mal
            return view("administrador.index")->with('incorrecto', "Algo ha salido mal");
        }
    }

    public function pdf(Request $request, $id)
    {
        $informe = $request->session()->get('informe');

        foreach ($informe as $item) {
            if ($item->id_informe == $id) {
                $item_informe[0] = $item;
            }
        }

        $data = [
            'title' => 'Grupo Acerero',
            'informes' => $item_informe
        ];
        $pdf = Pdf::loadView('Empleados.Administrador.Informes.pdf_informes', $data);
        return $pdf->stream();
    }
}
