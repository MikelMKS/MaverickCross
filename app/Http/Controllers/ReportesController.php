<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class ReportesController extends Controller
{
    public function __construct(){
        $this->tittle = "REPORTES";
    }

    public function index(){
        return view('Reportes.index')->with(['tittle' => $this->tittle]);
    }

    public function reportePendientes(){
        $tabla = DB::select("SELECT id,nombre,apellidoP,apellidoM,deuda FROM clientes WHERE deuda > 0");

        return view('Reportes.Pendientes.reportePendientes',compact('tabla'))->with(['tittle' => $this->tittle,'subtit' => 'Pendientes','chart' => 'cPendientes']);
    }

    // ///////////////////////////////////////////////////////////////////////////////

    public function reporteCorte(){
        return view('Reportes.Corte.reporteCorte')->with(['tittle' => $this->tittle,'subtit' => 'Corte','chart' => 'cCorte']);
    }

    public function reporteCorteTabla(){
        $inicio = $_REQUEST['inicio'];
        $fin = $_REQUEST['fin'];

        $tabla = DB::select("SELECT s_a.*,CONCAT(IFNULL(nombre,''),' ',IFNULL(apellidoP,''),' ',IFNULL(apellidoM,'')) AS Cliente
        ,IFNULL(TotalGym,0)+IFNULL(Semanal,0)+IFNULL(Visita,0)+IFNULL(Herbalife,0) AS Total
        FROM(
                    SELECT idCliente,MIN(CAST(fechaRegistro AS DATE)) AS Fecha
                    ,MIN(CASE WHEN idTipoPago = 1 THEN fechaInicio END) AS InicioGym
                    ,SUM(CASE WHEN (idTipoPago = 1 OR idReferencia = 1) THEN importe END) AS TotalGym
                    ,NULLIF(COUNT(CASE WHEN (idTipoPago = 1 OR idReferencia = 1) THEN id END),0) AS PagosGym
                    ,SUM(CASE WHEN (idTipoPago = 3 OR idReferencia = 3) THEN importe END) AS Semanal
                    ,SUM(CASE WHEN (idTipoPago = 2 OR idReferencia = 2) THEN importe END) AS Visita
                    ,SUM(CASE WHEN (idTipoPago = 4 OR idReferencia = 4) THEN importe END) AS Herbalife
                    FROM pagos AS p
                    WHERE CAST(fechaRegistro AS DATE) BETWEEN '{$inicio}' AND '{$fin}'
                    GROUP BY idCliente
        ) AS s_a
        LEFT JOIN(SELECT id,nombre,apellidoP,apellidoM FROM clientes) AS c ON s_a.idCliente = c.id
        ORDER BY fecha ASC
        ");

        return view('Reportes.Corte.reporteCorteTabla',compact('tabla','inicio','fin'));
    }

    public function drillSeccion(){
        $seccion = $_REQUEST['seccion'];
        $idCliente = $_REQUEST['idCliente'];
        $cliente = $_REQUEST['cliente'];
        $idTipo = $_REQUEST['idTipo'];
        $inicio = $_REQUEST['inicio'];
        $fin = $_REQUEST['fin'];

        $tabla = DB::select("SELECT CAST(fechaRegistro AS DATE) AS fecha,CASE WHEN idTipoPago = 5 THEN 'P' ELSE 'R' END AS tipo,observacion,importe,pendiente
        FROM pagos AS p
        WHERE idCliente = {$idCliente} AND (idTipoPago = {$idTipo} OR idReferencia = {$idTipo}) AND CAST(fechaRegistro AS DATE) BETWEEN '{$inicio}' AND '{$fin}'
        ORDER BY fechaRegistro ASC
        ");

        return view('Reportes.Corte.drillSeccion',compact('tabla','seccion','cliente','inicio','fin'));
    }

    public function drillTotalGeneral(){
        $idCliente = $_REQUEST['idCliente'];
        $cliente = $_REQUEST['cliente'];
        $inicio = $_REQUEST['inicio'];
        $fin = $_REQUEST['fin'];

        $tabla = DB::select("SELECT CAST(fechaRegistro AS DATE) AS fecha,tp.tipo AS tipo,r.tipo AS referencia,observacion,importe,pendiente
        FROM pagos AS p
        LEFT JOIN(SELECT * FROM tipopagos) AS tp ON p.idTipoPago = tp.id
        LEFT JOIN(SELECT * FROM tipopagos) AS r ON p.idReferencia = r.id
        WHERE idCliente = {$idCliente} AND CAST(fechaRegistro AS DATE) BETWEEN '{$inicio}' AND '{$fin}'
        ORDER BY fechaRegistro ASC
        ");

        return view('Reportes.Corte.drillTotalGeneral',compact('tabla','cliente','inicio','fin'));
    }

    // ///////////////////////////////////////////////////////////////////////////////

    public function reporteMembresias(){
        $clientes = DB::select("SELECT id,CONCAT(IFNULL(nombre,''),' ',IFNULL(apellidoP,''),' ',IFNULL(apellidoM,'')) AS cliente FROM clientes");
        $tipos = DB::select("SELECT id,tipo FROM tipopagos WHERE id IN (1,2,3)");

        return view('Reportes.Membresias.reporteMembresias',compact('clientes','tipos'))->with(['tittle' => $this->tittle,'subtit' => 'Membresias','chart' => 'cMembresias']);
    }

    public function reporteMembresiasTabla(){
        $cliente = $_REQUEST['cliente'];
        $tipo = $_REQUEST['tipo'];
        $estatus = $_REQUEST['estatus'];

        $inCliente = null;
        $inTipo = null;
        $inEstatus = null;

        foreach($cliente as $c){
            $inCliente.=$c.',';
        }
        foreach($tipo as $t){
            $inTipo.=$t.',';
        }
        foreach($estatus as $e){
            $inEstatus.=$e.',';
        }

        $inCliente = rtrim($inCliente,',');
        $inTipo = rtrim($inTipo,',');
        $inEstatus = rtrim($inEstatus,',');

        $tabla = DB::select("SELECT *,CASE WHEN sta = 'P' THEN 'PENDIENTE' WHEN sta = 'A' THEN 'ACTIVO' ELSE 'FINALIZADO' END AS estatus
        FROM(
                    SELECT *,CASE WHEN CURDATE() < fechaInicio THEN 'P' WHEN CURDATE() > fechaFin THEN 'F' ELSE 'A' END AS sta
                    FROM(
                                SELECT p.id,p.idCliente,cliente,t.tipo,p.observacion,p.fechaInicio
                                ,CASE
                                        WHEN idTipoPago = 1 THEN DATE_ADD(fechaInicio, INTERVAL 1 MONTH)
                                        WHEN idTipoPago = 2 THEN fechaInicio
                                        WHEN idTipoPago = 3 THEN DATE_ADD(fechaInicio, INTERVAL 1 WEEK)
                                END AS fechaFin
                                FROM pagos AS p
                                LEFT JOIN(SELECT id,CONCAT(IFNULL(nombre,''),' ',IFNULL(apellidoP,''),' ',IFNULL(apellidoM,'')) AS cliente FROM clientes) AS c ON p.idCliente = c.id
                                LEFT JOIN(SELECT id,tipo FROM tipopagos) AS t ON p.idTipoPago = t.id
                                WHERE p.idCliente IN ($inCliente) AND p.idTipoPago IN ($inTipo)
                    ) AS s_a
        ) AS s_b
        WHERE sta IN ($inEstatus)
        ORDER BY fechaInicio DESC
        ");

        return view('Reportes.Membresias.reporteMembresiasTabla',compact('tabla'));
    }
}
