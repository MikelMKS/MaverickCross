<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DateTime;

class AlertasController extends Controller
{
    public function __construct(){
        $this->tittle = "ALERTAS";
    }

    public function revisarAlertas(){
        $return = 0;
        $alertas = DB::connection('mysql')->select("SELECT id FROM alertas WHERE fecReg = CURDATE()");

        if($alertas == null){
            DB::connection('mysql')->delete("DELETE FROM alertas WHERE fecReg < CURDATE()");

            // CUMPLEAÑOS
            $cumpleaños = DB::connection('mysql')->select("SELECT COUNT(id) AS dato FROM clientes WHERE DATE_FORMAT(fechaNac,'%m-%d') = DATE_FORMAT(NOW(),'%m-%d')");
            if($cumpleaños[0]->dato > 0){
                DB::connection('mysql')->insert("INSERT INTO alertas (idTipo,visto,idUsuario,fecReg,dato) SELECT 1 AS idTipo,0 AS visto,id AS idUser,CURDATE() AS fecReg,".$cumpleaños[0]->dato." AS dato FROM usuarios");
            }

            // FIN MES
            DB::connection('mysql')->update("UPDATE pagos SET alertado = 0 WHERE alertado = 1 AND idTipoPago = 1");
            $finMes = DB::connection('mysql')->select("SELECT id AS dato FROM pagos WHERE CAST(DATE_ADD(fechaInicio, INTERVAL 1 MONTH) AS DATE) <= CURDATE() AND alertado IS NULL AND idTipoPago = 1");
            if($finMes != null){
                foreach($finMes as $f){DB::table('pagos')->where('id','=',$f->dato)->update(['alertado' => 1]);}
                DB::connection('mysql')->insert("INSERT INTO alertas (idTipo,visto,idUsuario,fecReg,dato) SELECT 2 AS idTipo,0 AS visto,id AS idUser,CURDATE() AS fecReg,".count($finMes)." AS dato FROM usuarios");
            }

            // FIN SEMANA
            DB::connection('mysql')->update("UPDATE pagos SET alertado = 0 WHERE alertado = 1 AND idTipoPago = 3");
            $finSemana = DB::connection('mysql')->select("SELECT id AS dato FROM pagos WHERE CAST(DATE_ADD(fechaInicio, INTERVAL 1 WEEK) AS DATE) <= CURDATE() AND alertado IS NULL AND idTipoPago = 3");
            if($finSemana != null){
                foreach($finSemana as $f){DB::table('pagos')->where('id','=',$f->dato)->update(['alertado' => 1]);}
                DB::connection('mysql')->insert("INSERT INTO alertas (idTipo,visto,idUsuario,fecReg,dato) SELECT 3 AS idTipo,0 AS visto,id AS idUser,CURDATE() AS fecReg,".count($finSemana)." AS dato FROM usuarios");
            }

            DB::connection('mysql')->table('alertas')->insert(['fecReg' => Date('Y-m-d')]);

            $return = 1;
        }

        return $return;
    }

    public function verNotificacion(){
        $tipo = $_REQUEST['tipo'];
        $hoy = new DateTime(date("Y-m-d"));

        // CUMPLEAÑOS
        if($tipo == 1){
            $datos = DB::connection('mysql')->select("SELECT *,TIMESTAMPDIFF(YEAR,fechaNac,CURDATE()) AS edad
            FROM clientes
            WHERE DATE_FORMAT(fechaNac,'%m-%d') = DATE_FORMAT(NOW(),'%m-%d')");
            $visto = DB::connection('mysql')->select("SELECT id,visto FROM alertas WHERE fecReg = CURDATE() AND idTipo = $tipo AND idUsuario = ".Session::get('Sid')."");

            return view('Alertas.cumple',compact('datos','hoy','visto'));
        }
        // FIN MES
        elseif($tipo == 2){
            $datos = DB::connection('mysql')->select("SELECT c.id,cliente,fechaInicio AS inicio,CAST(DATE_ADD(fechaInicio, INTERVAL 1 MONTH) AS DATE) AS fin
            ,TIMESTAMPDIFF(DAY, CAST(DATE_ADD(fechaInicio, INTERVAL 1 MONTH) AS DATE), CURDATE()) AS dias_transcurridos
            FROM pagos AS p
            LEFT JOIN(SELECT id,CONCAT(IFNULL(nombre,''),' ',IFNULL(apellidoP,''),' ',IFNULL(apellidoM,'')) AS cliente FROM clientes) AS c ON p.idCliente = c.id
            WHERE alertado = 1 AND idTipoPago = 1
            ");
            $visto = DB::connection('mysql')->select("SELECT id,visto FROM alertas WHERE fecReg = CURDATE() AND idTipo = $tipo AND idUsuario = ".Session::get('Sid')."");

            return view('Alertas.finMes',compact('datos','hoy','visto'));
        }
        // FIN SEMANA
        elseif($tipo == 3){
            $datos = DB::connection('mysql')->select("SELECT c.id,cliente,fechaInicio AS inicio,CAST(DATE_ADD(fechaInicio, INTERVAL 1 WEEK) AS DATE) AS fin
            ,TIMESTAMPDIFF(DAY, CAST(DATE_ADD(fechaInicio, INTERVAL 1 WEEK) AS DATE), CURDATE()) AS dias_transcurridos
            FROM pagos AS p
            LEFT JOIN(SELECT id,CONCAT(IFNULL(nombre,''),' ',IFNULL(apellidoP,''),' ',IFNULL(apellidoM,'')) AS cliente FROM clientes) AS c ON p.idCliente = c.id
            WHERE alertado = 1 AND idTipoPago = 3
            ");
            $visto = DB::connection('mysql')->select("SELECT id,visto FROM alertas WHERE fecReg = CURDATE() AND idTipo = $tipo AND idUsuario = ".Session::get('Sid')."");

            return view('Alertas.finSemana',compact('datos','hoy','visto'));
        }
    }

    public function enteradoCumpleaños(){
        $id = $_REQUEST['id'];

        DB::connection('mysql')->table('alertas')->where('id','=',$id)->update(['visto' => 1]);
    }

    public function enteradoFinMes(){
        $id = $_REQUEST['id'];

        DB::connection('mysql')->table('alertas')->where('id','=',$id)->update(['visto' => 1]);
    }

    public function enteradoFinSemana(){
        $id = $_REQUEST['id'];

        DB::connection('mysql')->table('alertas')->where('id','=',$id)->update(['visto' => 1]);
    }
}
