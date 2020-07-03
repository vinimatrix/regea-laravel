<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class querymaker extends Controller
{
    //
     public function FunctionName($tabla,$campo,$signo,$valor,$valor2=null,$and=false,$region=null,$provincia=null,$municipio=null)
    {

       // echo $valor2;

        if($signo=="BETWEEN" && ($valor2!=null || $valor2!='')){
            $signo = 'BETWEEN';
            $valor2 = "AND '$valor2'";
        }

        $add='';
        if($and){
            if ($tabla=="fincas") {
                if($region!=null && $region!=''){
                $add = "AND REG = '$region' ";
                }
                if($provincia!=null && $provincia!=''){
                $add = "AND REG = $region AND provinciaEstablecimiento='$provincia'";
                }
                if($municipio!=null && $municipio!=''){
                    $add = "AND REG = $region AND provinciaEstablecimiento='$provincia' AND municipioEstablecimiento='$municipio'";
                    }
                 }
                 if ($tabla=="productores_new") {
                    if($region!=null && $region!=''){
                    $add = "AND REG = '$region' ";
                    }
                    if($provincia!=null && $provincia!=''){
                    $add = "AND REG = $region AND PROV='$provincia'";
                    }
                    if($municipio!=null && $municipio!=''){
                        $add = "AND REG = $region AND PROV='$provincia' AND MUN='$municipio'";
                        }
                     }
        }
        $sql = DB::raw("SELECT * from $tabla WHERE $campo $signo '$valor' $valor2 $add");
        if($tabla =="productores_new"){
            $sql = DB::raw("SELECT Id, cedula,a1,nombre,apellidos from $tabla WHERE $campo $signo '$valor' $add");
        }
        //echo $sql;
        $res = DB::select($sql);
        if (in_array('Imagen', $res))
{
    unset($res[array_search('Imagen',$res)]);
}
        return response()->json($res,200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }
}
