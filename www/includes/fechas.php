<?php

/*
 * Formato de fecha FRI11JUN - > presentaci�n
 * Formato de fecha 11JUN04  - > base de datos
 */


$ahora= strtoupper(strftime("%Y-%m-%d"));
$aroha = strtoupper(strftime("%d-%m-%Y"));

$anio = strtoupper(strftime("%y"));
$nanio = abs(strftime("%Y"));
$nmes = abs(strftime("%m"));
$mes = nombreMes($nmes);
$dia = strtoupper(strftime("%d"));
$ndia = abs(strftime("%d"));
$hora = (date("Hi"));
$manana = strtoupper(date ( "jmy",mktime (0,0,0,$nmes,$ndia+1,$nanio)));
$ahoraN = strtoupper(strftime("%d%m"));
$mananaN = strtoupper(date ( "dm",mktime (0,0,0,$nmes,$ndia+1,$nanio)));
$ayerN = strtoupper(date ( "dm", mktime (0,0,0,$nmes,$ndia-1,$nanio)));
$ayer = strtoupper(date ( "jmy", mktime (0,0,0,$nmes,$ndia-1,$nanio)));
$anteayerN = strtoupper(date ( "dm", mktime (0,0,0,$nmes,$ndia-2,$nanio)));
$anteayer = strtoupper(date ( "jmy", mktime (0,0,0,$nmes,$ndia-2,$nanio)));
$fechaMes = date ( "Y-m-d", mktime (0,0,0,$nmes-1,$ndia,$nanio));

//int mktime ( int hour, int minute, int second, int month, int day, int year [, int is_dst])

$fechaGMT= strtoupper(gmdate("DdMy h:i:s", mktime (0,0,0,$nmes,$ndia,$nanio)));

// print "ma�ana $manana, ayer $ayer, $nmes, $mes, $ndia, $dia <br>GMT $fechaGMT";



/* FUNCIONES */

    function numeroMes($mes){
        $mesDatos=array('JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER');
        for($i=0;$i<12;$i++){
            $mMes=$mesDatos[$i];
            $mMes=strtoupper($mMes);
            $nMes=substr($mMes,0,3);
            //ECHO "$mes - $nMes<br>";
            if($nMes==$mes){
                $i=$i+1;
                if ($i<10)
                    $val='0'.$i;
                else
                    $val=$i	;
                return($val);
            }
        }
        return("00");
    }

    function vFecha($fechaD){
        $nanio = abs(strftime("%Y"));
        $fechaD=strtoupper($fechaD);
        $len=strlen($fechaD);

        if($len<5 ||$len>9){
            return (false);
        }
        $dia=substr($fechaD,0,2);
        $mesL=substr($fechaD,2,3);
        $mes=numeroMes($mesL)	;
        if($mes=="00"){
                return (false);
        }
        switch($len){
        case 5:
            $anio=$nanio;
            break;
        case 6:
            return(false);
            break;
        case 7:
            $anio="20".substr($fechaD,5,2);
            break;
        case 8:
            return(false);
            break;
        case 9:
            $anio=substr($fechaD,5,4);
            break;
        }
        $res= checkdate  ( $mes, $dia, $anio);
        if ($res){
            $res=$dia.$mes.$anio;
        }
        return($res);
    }


    function nombreMes($numero){
        //$mes = strtoupper(strftime("%b"));
        //$nmes = abs(strftime("%m"));
        $meses = array(1=>"JAN", "FEN", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");
        $nombre = $meses[$numero];
        return $nombre;
    }
?>