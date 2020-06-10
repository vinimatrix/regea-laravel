<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class sisee extends Controller
{
    //




    public function get_cedulado($cedula){
        $res =DB::connection('mysql2') ->
                                            table('CEDULADOS')->
                                            where('CEDULADOS.cedula',"$cedula")->
                                            leftJoin('fotos', 'CEDULADOS.cedula', '=', 'fotos.cedula')->
                                            join('PADRON_PRIMARIAS_2019 as p','CEDULADOS.cedula','=','p.Cedula')->
                                            join('Nacionalidad as n','CEDULADOS.COD_NACION','=','n.ID')->
                                            select('CEDULADOS.*','p.nombres',
                                            DB::raw("CONCAT(p.apellido1,' ',p.apellido2) as apellidos"),
                                            'n.Descripcion as Nacionalidad',
                                              'fotos.Imagen as foto')->get();
        if($res!=null){                                    
        $res[0]->foto = base64_encode($res[0]->foto);
        $res = $res[0];
        }

        return response()->json($res,200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
     }

     public function get_rnc($rnc){}


}
