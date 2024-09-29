<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class ClientesController extends Controller
{
    public function __construct(){
        $this->tittle = "CLIENTES";
    }

    public function index(){
        $clientes = DB::connection('mysql')->select("SELECT c.*,registro
        FROM clientes AS c
        LEFT JOIN(SELECT id,user AS registro FROM usuarios) AS u ON c.idRegistro = u.id
        ");

        return view('Clientes.index',compact('clientes'))->with(['tittle' => $this->tittle]);
    }

    public function guardarCliente(Request $request){
        $response = array('sta' => 0,'msg' => ''); 

        $nombre = $request->nombre;
        $apellidoPat = $request->apellidoPat;
        $apellidoMat = $request->apellidoMat;
        $telefono = $request->telefono;
        $nacimiento = $request->nacimiento;
        $foto = $request->file('foto');

        $response = noVacio($nombre,'NOMBRE',$response);

        if($response['sta'] == 0){
            !empty($nombre) ? $whereNombre = "= '$nombre'" : $whereNombre = 'IS NULL';
            !empty($apellidoPat) ? $whereApePat = "= '$apellidoPat'" : $whereApePat = 'IS NULL';
            !empty($apellidoMat) ? $whereApeMat = "= '$apellidoMat'" : $whereApeMat = 'IS NULL';
            $consultar = DB::connection('mysql')->select("SELECT id FROM clientes WHERE nombre $whereNombre AND apellidoP $whereApePat AND apellidoM $whereApeMat");

            if($consultar != null){
                $response['sta'] = '1';
                $response['msg'] = "YA EXISTE UN CLIENTE CON ESE NOMBRE";
            }

            if($response['sta'] == 0){
                DB::connection('mysql')->table('clientes')->insert([
                    'nombre' => $nombre,
                    'apellidoP' => $apellidoPat,
                    'apellidoM' => $apellidoMat,
                    'telefono' => $telefono,
                    'fechaNac' => $nacimiento,
                    'idRegistro' => Session::get('Sid'),
                    'fechaRegistro' => Date('Y-m-d H:i')
                ]);

                if($foto != null){
                    $nextid = DB::getPdo()->lastInsertId();

                    $filename = $nextid.'.png';
                    \Storage::disk('clientes')->put($filename, \File::get($foto));
                }
            }
        }

        echo json_encode($response);
    }

    public function agregarClienteMain(){
        return view('Clientes.agregarClienteMain');
    }

    public function verCliente(){
        $id = $_REQUEST['id'];

        $cliente = DB::connection('mysql')->select("SELECT * FROM clientes WHERE id = $id");

        return view('Clientes.verCliente',compact('cliente'));
    }

    public function updateCliente(Request $request){
        $response = array('sta' => 0,'msg' => ''); 

        $id = $request->idCliente;
        $nombre = $request->nombre;
        $apellidoPat = $request->apellidoPat;
        $apellidoMat = $request->apellidoMat;
        $telefono = $request->telefono;
        $nacimiento = $request->nacimiento;
        $foto = $request->file('foto');

        $response = noVacio($nombre,'NOMBRE',$response);

        if($response['sta'] == 0){
            !empty($nombre) ? $whereNombre = "= '$nombre'" : $whereNombre = 'IS NULL';
            !empty($apellidoPat) ? $whereApePat = "= '$apellidoPat'" : $whereApePat = 'IS NULL';
            !empty($apellidoMat) ? $whereApeMat = "= '$apellidoMat'" : $whereApeMat = 'IS NULL';
            $consultar = DB::connection('mysql')->select("SELECT id FROM clientes WHERE nombre $whereNombre AND apellidoP $whereApePat AND apellidoM $whereApeMat AND id != $id");

            if($consultar != null){
                $response['sta'] = '1';
                $response['msg'] = "YA EXISTE UN CLIENTE CON ESE NOMBRE";
            }

            if($response['sta'] == 0){
                DB::connection('mysql')->table('clientes')->where('id','=',$id)->update([
                    'nombre' => $nombre,
                    'apellidoP' => $apellidoPat,
                    'apellidoM' => $apellidoMat,
                    'telefono' => $telefono,
                    'fechaNac' => $nacimiento,
                    'idRegistro' => Session::get('Sid'),
                    'fechaRegistro' => Date('Y-m-d H:i')
                ]);

                if($foto != null){
                    $nextid = $id;

                    $filename = $nextid.'.png';
                    \Storage::disk('clientes')->put($filename, \File::get($foto));
                }
            }
        }

        echo json_encode($response);
    }

}
