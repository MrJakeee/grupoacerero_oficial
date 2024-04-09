<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class indexController extends Controller
{
    public function index()
    {
        return view("bienvenida");
    }
}
