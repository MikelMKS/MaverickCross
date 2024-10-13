<?php

function fecha($fecha){
    if ($fecha == '') {
        $fechaFin = '';
    }else{
        $dia = date('d', strtotime($fecha));
        $mes = date('m', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $fechaFin = $dia .'-'. $mes .'-'. $anio;
    }
    return $fechaFin;
}

function fechaFormato($fecha){
    if ($fecha == '') {
        $fechaFin = '';
    }else{
        $dia = date('d', strtotime($fecha));
        $mes = substr(mes(date('n', strtotime($fecha))), 0, 3);
        $anio = date('Y', strtotime($fecha));
        $fechaFin = $dia .''. $mes .''. $anio;
    }
    return $fechaFin;
}

function mes($mes){
    $elmes = [' ', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
                   'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
    if(empty($elmes[$mes])){
        return 'NA';
    } else {
        return $elmes[$mes];
    }
}

function noVacio($val,$nombre,$response){
    if($response['sta'] == '0'){
        if(empty($val)){
            $response['sta'] = '1';
            $response['msg'] = "DEBES LLENAR EL CAMPO '".$nombre."'";
        }else{
            $response['sta'] = '0';
            $response['msg'] = "";
        }
    }

    return $response;
}

function flotFormatoM($val){
    $for = number_format($val, 0, '.', ',');
    if($for <= '0'){
        $for = null;
    }
    return $for;
}

function flotFormatoM2($val){
    $for = number_format($val, 2, '.', ',');
    if($for <= '0'){
        $for = null;
    }
    return $for;
}

function flotFormatoM2Negativa($val){
    $for = number_format($val, 2, '.', ',');

    return $for;
}

function flotFormatoM20($val){
    $for = number_format($val, 2, '.', ',');
    if($for <= '0'){
        $for = 0;
    }
    return $for;
}

function flotFormatoMPesos($val){
    $for = number_format($val, 0, '.', ',');
    if($for <= '0'){
        $for = null;
    }else{
        $for = '$ '.$for;
    }
    return $for;
}

function flotFormatoM2Pesos($val){
    $for = number_format($val, 2, '.', ',');
    if($for <= '0'){
        $for = null;
    }else{
        $for = '$ '.$for;
    }
    return $for;
}

function existeArchivo($ruta,$nombre){
    $busca = '../public/'.$ruta.'/'.$nombre;
    return file_exists($busca)?TRUE:FALSE;
}

?>
