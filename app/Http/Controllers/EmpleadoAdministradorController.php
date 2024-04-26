<?php

namespace App\Http\Controllers;


use App\Exports\EmpleadoAdminExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;


class EmpleadoAdministradorController extends Controller
{
    public function index(Request $request)
    {

        //Obtener datos del empleado con rango administrador
        $datos_empleado_administrador = $request->session()->get('datos_empleado_administrador');

        //Creacion de SQL
        $sql_informes = DB::select("SELECT * FROM informes JOIN grupoacerero_oficial.empleados e on informes.id_empleado = e.id_empleado JOIN grupoacerero_oficial.proovedores p on informes.id_proovedor = p.id_proovedor WHERE status = false;");


        //Compruebo si el SQL funciona correctamente
        if (!empty($sql_informes)){
            //Ingreso como una Session los informes
            $request->session()->put('datos_admin', $datos_empleado_administrador);
            $request->session()->put('informe', $sql_informes);
            //Regreso a la vista
            return view("Empleados.Administrador.Empleado_administrador")->with(['datos_admin' => $datos_empleado_administrador,
                'informes' => $sql_informes]);
        }else{
            //Regreso a la vista con mensaje mal
            return view("administrador.index")->with('incorrecto', "Algo ha salido mal");
        }
    }

    public function buscarInformePorFecha(Request $request)
    {
        try {
            $informePorFecha = DB::select("
            SELECT * FROM informes
            JOIN grupoacerero_oficial.empleados e on informes.id_empleado = e.id_empleado
            JOIN grupoacerero_oficial.proovedores p on informes.id_proovedor = p.id_proovedor
            WHERE status = false AND DATE(hora_entrada) = (?);", [
                $request->fecha
            ]);

            if (!empty($informePorFecha)){
                $request->session()->put('informes', $informePorFecha);
                return view('Empleados.Administrador.Empleado_administrador')->with(['informes' => $informePorFecha,
                    'datos_admin' => $request->session()->get('datos_admin')]);
            }else{
                return redirect()->route('administrador.index')->with('incorrecto', "Posiblemente la fecha que asigno, no corresponde con algun registro");
            }
        }catch (\Throwable $throwable){
            return redirect()->route('administrador.index')->with('incorrecto', "Posiblemente la fecha que asigno, no corresponde con algun registro " . $throwable);
        }
    }


    public function pdf(Request $request, $id)
    {
        $informe = $request->session()->get('informe');

        foreach ($informe as $item) {
            if ($item->id_informe == $id) {
                $item_informe[0] = $item;
                break;
            }
        }

        $data = [
            'title' => 'Informe de Grupo Acerero',
            'informes' => $item_informe
        ];
        $pdf = Pdf::loadView('Empleados.Administrador.Informes.pdf_informes', $data);
        return $pdf->stream();
    }

    public function excel(Request $request, $id)
    {
        // Accede a los datos de la sesión
        $sesionData = $request->session()->get('informe');

        // Si tienes datos en la sesión, agrégalos a tus informes
        foreach ($sesionData as $informes){
            if ($informes->id_informe == $id){
                $informe[] = $informes;
            }
        }

        // Convierte los datos en una colección
        $colección = collect($informe);

        // Devuelve el archivo Excel
        return Excel::download(new EmpleadoAdminExport($colección), 'informes.xlsx');
    }

}
