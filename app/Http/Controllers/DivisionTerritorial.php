<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisionTerritorial extends Controller
{
    //
    public function ListRegiones(){
        $res = DB::table('Regiones')->get();
        return response()->json($res,200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }


    public function ListProvincias(string $region=""){
        if ($region!="") {
            $res = DB::table('provcenso2010')->where('REG', $region)->get();
            return response()->json($res, 200, [], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }

        $res = DB::table('provcenso2010')->get();
            return response()->json($res, 200, [], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }


    public function ListMunicipios(string $provincia){
        $res = DB::table('muncenso2010')->where('PROV',$provincia)->get();
        return response()->json($res,200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }


    public function ListDistritos(string $provincia,string $municipio){
        $res = DB::table('dmcenso2010')->where('PROV',$provincia,true)->where('MUN',$municipio)->get();
        return response()->json($res,200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }


    public function ListSecciones(string $provincia,string $municipio,$distrito){
        $res = DB::table('seccenso2010')->where('PROV',$provincia,true)
        ->where('MUN',$municipio,true)
        ->where('DM',$distrito)->get();
        return response()->json($res,200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }


    public function ListBarrioParaje(string $provincia,string $municipio,string $distrito,string $seccion){
        $res = DB::table('bpcenso2010')->where('PROV',$provincia,true)
        ->where('MUN',$municipio,true)
        ->where('DM',$distrito)->get();
        return response()->json($res,200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }
    public function ListSubBarrios(string $provincia,string $municipio,string $distrito,string $seccion, string $barrio){}
}
