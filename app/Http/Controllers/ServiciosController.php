<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class ServiciosController extends Controller
{
    public function __construct(){
        $this->tittle = "SERVICIOS";
    }

    public function index(){
        $clientes = DB::connection('mysql')->select("SELECT id,nombre,apellidoP,apellidoM FROM clientes ORDER BY nombre ASC");
        $servicios = DB::connection('mysql')->select("SELECT * FROM tipopagos ORDER BY id ASC");

        isset($_REQUEST['idCliente']) ? $idCliente = $_REQUEST['idCliente'] : $idCliente = null;

        return view('Servicios.index',compact('clientes','servicios','idCliente'))->with(['tittle' => $this->tittle]);
    }

    public function serviciosTabla(){
        $cliente = $_REQUEST['cliente'];
        $servicio = $_REQUEST['servicio'];
        $inicio = $_REQUEST['inicio'];
        $fin = $_REQUEST['fin'];

        $whereServicio = null;
        $whereFecha = null;

        if(!empty($servicio)){
            $whereServicio = "AND idTipoPago = {$servicio}";
        }

        if(!empty($inicio) && empty($fin)){
            $whereFecha = "AND fechaRegistro >= '{$inicio}'";
        }elseif(empty($inicio) && !empty($fin)){
            $whereFecha = "AND fechaRegistro <= '{$fin}'";
        }elseif(!empty($inicio) && !empty($fin)){
            $whereFecha = "AND fechaRegistro BETWEEN '{$inicio}' AND '{$fin}'";
        }

        $tabla = DB::connection('mysql')->select("SELECT p.*,tp.tipo AS tipo,tr.tipo AS referencia,u.registro
        FROM pagos AS p
        LEFT JOIN(SELECT * FROM tipopagos) AS tp ON p.idTipoPago = tp.id
        LEFT JOIN(SELECT * FROM tipopagos) AS tr ON p.idReferencia = tr.id
        LEFT JOIN(SELECT id,user AS registro FROM usuarios) AS u ON p.idRegistro = u.id
        WHERE idCliente = {$cliente} $whereServicio $whereFecha
        ORDER BY id ASC
        ");

        $datosCliente = DB::select("SELECT deuda FROM clientes WHERE id = {$cliente}");

        return view('Servicios.serviciosTabla',compact('tabla','datosCliente'));
    }

    public function deudaCliente(){
        $cliente = $_REQUEST['cliente'];

        $buscar = DB::connection('mysql')->select("SELECT id,IFNULL(deuda,0) AS deuda FROM clientes WHERE id = $cliente");

        return flotFormatoM20($buscar[0]->deuda);
    }

    public function buscaMembresiasActivas(){
        $cliente = $_REQUEST['cliente'];
        
        $tabla = DB::connection('mysql')->select("SELECT *,CASE WHEN CURDATE() < fechaInicio THEN 'PENDENTE' WHEN CURDATE() > fechaFin THEN 'FINALIZADO' ELSE 'ACTIVO' END AS sta
        FROM(
            SELECT p.id,t.tipo,p.observacion,p.fechaInicio
            ,CASE 
                WHEN idTipoPago = 1 THEN DATE_ADD(fechaInicio, INTERVAL 1 MONTH) 
                WHEN idTipoPago = 2 THEN fechaInicio
                WHEN idTipoPago = 3 THEN DATE_ADD(fechaInicio, INTERVAL 1 WEEK)
            END AS fechaFin
            FROM pagos AS p
            LEFT JOIN(SELECT id,tipo FROM tipopagos) AS t ON p.idTipoPago = t.id
            WHERE idCliente = $cliente AND p.idTipoPago IN (1,2,3)
        ) AS sg
        WHERE CURDATE() <= fechaFin
        ");

        return view('Servicios.membresiasActivas',compact('tabla'));
    }

    public function guardarServicio(Request $request){
        $response = array('sta' => 0,'msg' => ''); 

        $cliente = $request->clientesNR;
        $servicio = $request->serviciosNR;
        $referencia = $request->referenciaNR;
        $fecini = $request->feciniNR;
        $importe = str_replace(',','',$request->importeNR);
        $pendiente = str_replace(',','',$request->pendienteNR);
        $observacion = $request->observacionNR;

        $response = noVacio($cliente,'CLIENTE',$response);
        $response = noVacio($servicio,'SERVICIO',$response);
        $response = noVacio($importe,'IMPORTE',$response);

        if(in_array($servicio,[1,2,3])){
            $response = noVacio($fecini,'FECHA INICIO',$response);
        }elseif($servicio == 5){
            $response = noVacio($referencia,'REFERENCIA',$response);
        }

        if($response['sta'] == 0){

            $consultar = DB::connection('mysql')->select("SELECT id,IFNULL(deuda,0) AS deuda FROM clientes WHERE id = '$cliente'");
            $deuda = $consultar[0]->deuda;

            if($servicio == 5){
                $total = $deuda-$importe;
            }else{
                $total = $deuda+$pendiente;
            }

            if($total < 0){
                $total = null;
            }

            DB::connection('mysql')->table('clientes')->where('id','=',$cliente)->update(['deuda' => $total]);

            DB::connection('mysql')->table('pagos')->insert([
                'idCliente' => $cliente,
                'idTipoPago' => $servicio,
                'idReferencia' => $referencia,
                'importe' => $importe,
                'pendiente' => empty($pendiente) ? null : $pendiente,
                'observacion' => $observacion,
                'fechaInicio' => $fecini,
                'idRegistro' => Session::get('Sid'),
                'fechaRegistro' => Date('Y-m-d H:i'),
            ]);

        }

        echo json_encode($response);
    }

    public function agregarServicioMain(){

        $clientes = DB::connection('mysql')->select("SELECT id,nombre,apellidoP,apellidoM FROM clientes ORDER BY nombre ASC");
        $servicios = DB::connection('mysql')->select("SELECT * FROM tipopagos ORDER BY id ASC");

        return view('Servicios.agregarServicioMain',compact('clientes','servicios'));
    }

    public function cambiarFecIni(){
        $id = $_REQUEST['id'];
        
        $datos = DB::connection('mysql')->select("SELECT * 
        FROM pagos AS p
        LEFT JOIN(SELECT id AS idT,tipo FROM tipopagos) AS t ON p.idTipoPago = t.idT
        WHERE id = {$id}
        ");

        return view('Servicios.cambiarFecIni',compact('datos'));
    }

    public function guardarEdicionMembresia(Request $request){
        $response = array('sta' => 0,'msg' => ''); 

        $id = $request->idMembresiaEditar;
        $fecini = $request->feciniEMemb;
        $observacion = $request->observacionEMemb;

        DB::connection('mysql')->table('pagos')->where('id','=',$id)->update([
            'observacion' => $observacion,
            'fechaInicio' => $fecini,
            'idRegistro' => Session::get('Sid'),
        ]);

        echo json_encode($response);
    }
}
