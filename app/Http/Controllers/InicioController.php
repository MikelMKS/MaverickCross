<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class InicioController extends Controller
{
    public function __construct(){
        $this->tittle = "INICIO";
    }

    public function index(){
        return view('Inicio.index')->with(['tittle' => $this->tittle]);
    }

    public function tabla(){
        return view('Inicio.tabla')->with(['tittle' => $this->tittle]);
    }
}
