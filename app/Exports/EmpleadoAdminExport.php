<?php

namespace App\Exports;

use FontLib\TrueType\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;

class EmpleadoAdminExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */


    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return \view('Empleados.Administrador.Informes.excel_informes',[
            'data' => $this->data
        ]);
    }

}
