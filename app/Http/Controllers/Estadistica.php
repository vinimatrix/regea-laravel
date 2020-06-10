<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Estadistica extends Controller
{
    //
    public function actividades($region='',$provincia='',$municipio='',$distrito='',$seccion='',$barrio=''){
        //DB::statement('drop table users')
    }
    public function estadisticas($region='',$provincia='',$municipio='',$distrito='',$seccion='',$barrio=''){
        $a='';
        $b='';
        $c='';
        if ($region!='') {
            $a = "WHERE REG ='$region'";
            $b = "AND REG ='$region'";
            $c=$a;
        }

        if ($provincia!='') {
            /*********Estadistica Provincial*******************/
            $a = "WHERE a.PROV='$provincia'";
            $b = "AND a.PROV='$provincia'";
            $c = "WHERE  b.provinciaEstablecimiento='$provincia'";
        }

        if ($municipio!='') {
            $a = "WHERE a.PROV='$provincia' AND a.MUN ='$municipio'";
            $b = "AND a.PROV='$provincia' AND a.MUN ='$municipio'";
            $c = "WHERE  b.provinciaEstablecimiento='$provincia' AND b.municipioEstablecimiento='$municipio'";
        }
        $res = DB::raw("SELECT
    (SELECT COUNT(*)  FROM  productores_new a $a ) as ProductoresTotal,
    (SELECT COUNT(*) FROM fincas b $c )as Fincas_levantadas,
    (SELECT SUM(areaProdAgricola)  FROM  fincas b  $c) as AgriculturaTotal,
    (SELECT SUM(areaProdAnimal)  FROM  fincas b $c) as AgropecuariaTotal,
    (SELECT SUM(areaBosqueOForestal)  FROM  fincas b $c ) as BosquesTotal,
    (SELECT SUM(areaVarias)  FROM  fincas  b $c) as AreaGeneral,
    (SELECT SUM(areaInfraEstructura)  FROM  fincas b $c) as InfraestructuraTotal,

    (SELECT COUNT(*)  FROM  productores_new  a WHERE a.Sexo = 'F' $b ) as Mujeres,
    (SELECT COUNT(*)  FROM  productores_new  a WHERE a.Sexo = 'M' $b) as Hombres");

    $res = DB::select($res);
    if($res){
        $res = $res[0];
    }

        return response()->json($res,200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }


/******************************************************************************************************************** */
    public function Graficos($region='',$provincia='', $municipio='', $distrito='',$seccion='',$barrio=''){
        $p1='';

        if ($region!='') {
            $p1 = "WHERE REG ='$region'";
        }
        if ($region!='' && $provincia!='') {
            $p1 = "WHERE REG ='$region' AND provinciaEstablecimiento='$provincia'";
        }
        if ($region!='' && $municipio!='' && $provincia!='') {
            $p1 = "WHERE provinciaEstablecimiento='$provincia' AND municipioEstablecimiento='$municipio'";
        }


        $res = DB::raw("SELECT b.finalidadPrincipal as Actividad,b.Conteo
        FROM
        (SELECT
        COUNT(fincas.finalidadPrincipal) as Conteo ,fincas.finalidadPrincipal
        FROM
        fincas
        $p1
        GROUP BY
        finalidadPrincipal
        ) as b ORDER BY b.Conteo DESC
        LIMIT 5");
        //echo $res;
        $ob = [];
        $ret=[];
        $series=[];
        $labes=[];

        $query = DB::select($res);
        foreach ($query as $row) {
            array_push($labes,$row->Actividad);
            array_push($series,$row->Conteo);
        }

         $ret['act']=array('series'=>$series,'labels'=>$labes);

          /*************************************************************************** */
          if ($region!='') {
            $p1 = "AND REG='$region'";
        }
        if ($region!='' && $provincia!='') {
            $p1 = "AND PROV='$provincia' AND REG='$region'";
        }

        if ($region!='' && $municipio!='' && $provincia!='') {
            $p1 = "AND PROV='$provincia' AND MUN='$municipio'";
        }

        $sql = DB::raw("SELECT
        (SELECT COUNT(a.Sexo) FROM productores_new a WHERE a.Sexo ='M' $p1)as Hombres,
        (SELECT COUNT(a.Sexo) FROM productores_new a WHERE a.Sexo ='F' $p1)as Mujeres");
        $row = DB::select($sql);
        $ob = array(
            ['Hombres',$row[0]->Hombres*1],
           ['Mujeres',$row[0]->Mujeres*1],
              'labels'=>['Hombres','Mujeres'],
              'series'=>[($row[0]->Hombres*1),($row[0]->Mujeres*1)]

          );
          $se= ['sex'=>$ob];
          $ret['sex'] = $ob;
          /****************************************************************** */

          if ($region!='') {
            $p1 = "WHERE REG= '$region'";
        }

        if ($region!='' && $provincia!='') {
            $p1 = "WHERE provinciaEstablecimiento='$provincia' AND REG= '$region'";
        }

         if ($region!='' && $municipio!='' && $provincia!='') {
            $p1 = "WHERE provinciaEstablecimiento='$provincia' AND municipioEstablecimiento='$municipio'";
        }

        $sql = DB::raw("SELECT

        (SELECT SUM(areaProdAgricola)  FROM  fincas  $p1) as AreaAgricultura,
        (SELECT SUM(areaProdAnimal)  FROM  fincas $p1) as AreaAgropecuaria,
        (SELECT SUM(areaBosqueOForestal)  FROM  fincas  $p1) as AreaBosques,
        (SELECT SUM(areaInfraEstructura)  FROM  fincas $p1) as InfraestructuraTotal");
        $row = DB::select($sql);

        $ob = [
              ['Area Agropecuaria','Area Bosques','Area Infraestructura','Area Agricultura'],
           'series'=> [($row[0]->AreaAgropecuaria*1),
             $row[0]->AreaBosques*1,
             $row[0]->InfraestructuraTotal*1,
              $row[0]->AreaAgricultura*1
              ]
        ];
        $ret['ar'] = $ob;
        return response()->json($ret,200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

    }

}
