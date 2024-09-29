<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class AdministrativosController extends Controller
{
    public function __construct(){
        $this->tittle = "ADMINISTRATIVOS";
    }

    public function index(){
        $administrativos = DB::connection('mysql')->select("SELECT * FROM usuarios WHERE estatus != 2");

        return view('Administrativos.index',compact('administrativos'))->with(['tittle' => $this->tittle]);
    }

    public function agregarAdministrativo(){
        return view('Administrativos.agregarAdministrativo');
    }

    public function guardarAdministrativo(Request $request){
        $response = array('sta' => 0,'msg' => '');

        $usuario = $request->usuario;
        $contraseña = $request->contraseña;
        $nombre = $request->nombre;
        $imagen = $request->file('imagen');

        $response = noVacio($usuario,'USUARIO',$response);
        $response = noVacio($contraseña,'CONTRASEÑA',$response);

        if($response['sta'] == 0){
            $consultar = DB::connection('mysql')->select("SELECT id FROM usuarios WHERE user = '$usuario'");

            if($consultar != null){
                $response['sta'] = '1';
                $response['msg'] = "YA EXISTE UN USUARIO CON ESE NOMBRE";
            }

            if($response['sta'] == 0){
                DB::connection('mysql')->table('usuarios')->insert([
                    'user' => $usuario,
                    'pass' => $contraseña,
                    'idTipo' => 2,
                    'nombre' => $nombre,
                    'estatus' => 1
                ]);

                if($imagen != null){
                    $nextid = DB::getPdo()->lastInsertId();

                    $filename = $nextid.'.png';
                    \Storage::disk('administrativos')->put($filename, \File::get($imagen));
                }
            }
        }

        echo json_encode($response);
    }

    public function accionesAdministrativo(){
        $id = $_REQUEST['id'];
        $t = $_REQUEST['t'];

        DB::connection('mysql')->table('usuarios')->where('id','=',$id)->update(['estatus' => $t]);
    }

    public function editarAdministrativo(){
        $id = $_REQUEST['id'];
        $datos = DB::connection('mysql')->select("SELECT * FROM usuarios WHERE id = '$id'");

        return view('Administrativos.editarAdministrativo',compact('id','datos'));
    }

    public function updateAdministrativo(Request $request){
        $response = array('sta' => 0,'msg' => '');

        $id = $request->idEdit;
        $usuario = $request->usuarioEdit;
        $contraseña = $request->contraseñaEdit;
        $nombre = $request->nombreEdit;
        $imagen = $request->file('imagenEdit');

        $response = noVacio($usuario,'USUARIO',$response);
        $response = noVacio($contraseña,'CONTRASEÑA',$response);

        if($response['sta'] == 0){
            $consultar = DB::connection('mysql')->select("SELECT id FROM usuarios WHERE user = '$usuario' AND id != '$id'");

            if($consultar != null){
                $response['sta'] = '1';
                $response['msg'] = "YA EXISTE UN USUARIO CON ESE NOMBRE";
            }

            if($response['sta'] == 0){
                DB::connection('mysql')->table('usuarios')->where('id','=',$id)->update([
                    'user' => $usuario,
                    'pass' => $contraseña,
                    'nombre' => $nombre,
                ]);

                if($imagen != null){
                    $filename = $id.'.png';
                    \Storage::disk('administrativos')->put($filename, \File::get($imagen));
                }
            }
        }

        echo json_encode($response);
    }
}
