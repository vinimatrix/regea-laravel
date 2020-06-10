<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Productores extends Controller
{
    //
    public function index()
    {
        $data = DB::table('productores_new')->get();
        $data = $data->jsonSerialize();
        foreach ($data as $i) {
            $i->Imagen = base64_encode($i->Imagen);
        }
        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function ByRegion(string $region)
    {
        $data = DB::table('productores_new')->where('REG', $region)->get();
        $data = $data->jsonSerialize();
        foreach ($data as $i) {
            $i->Imagen = base64_encode($i->Imagen);
        }
        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
        // return $region;
    }


    public function ByProvincia(string $provincia)
    {
        $data = DB::table('productores_new')->where('PROV', $provincia)->get();
        $data = $data->jsonSerialize();
        foreach ($data as $i) {
            $i->Imagen = base64_encode($i->Imagen);
        }
        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }


    public function ByMunicipio(string $provincia, string $municipio)
    {
        $data = DB::table('productores_new')->where('PROV', $provincia, true)->where('MUN', $municipio)->get();
        $data = $data->jsonSerialize();
        foreach ($data as $i) {
            $i->Imagen = base64_encode($i->Imagen);
        }
        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }


    public function ByDistrito(string $provincia, string $municipio, string $distrito)
    {
    }
    public function BySeccion(string $provincia, string $municipio, string $distrito, string $seccion)
    {
    }
    public function ByBarrio(string $provincia, string $municipio, string $distrito, string $seccion, string $barrio)
    {
    }
    public function ByMultiProvincia($provincias)
    {
    }
    public function ByMultiMunicipios($data)
    {
    }

    public function findByCedula($cedula)
    {
        $res= DB::select('select * from productores_new where cedula = ?', [$cedula]);
        /*$res = DB::table('productores_new')
               ->where('cedula', $cedula)->get();*/
        if($res){
            $res[0]->Imagen = base64_encode($res[0]->Imagen);
        }
        return response()->json($res[0], 200, [], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }

    public function getById($id){
        $res = DB::table('productores_new')->where('Id',$id)->get();
        if($res!=null){
        $fincas = DB::table('fincas')
        ->where('cedulaRepresentanteLegal',$res[0]->cedula)
       // ->join('provcenso2010 as p','fincas.provinciaEstablecimiento','=','p.PROV')
        //->join('muncenso2010 as m',DB::raw('fincas.provinciaEstablecimiento = m.PROV AND fincas.municipioEstablecimiento = m.MUN'),'')
        ->get();
        $res[0]->fincas = $fincas;
        $res[0]->Imagen = base64_encode($res[0]->Imagen);
        return response()->json($res[0],200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }
        return response()->json($res,200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }

    ///////////CRUD////////////////
    public function Create(Request $request){
        $data = $request->json()->all();
        $fechaIntrod=$data['fechaIntrod'];
$codOper=$data['codOper'];
$areaAgopecuaria=$data['areaAgopecuaria'];
$nombres=$data['nombres'];
$RNC=$data['RNC'];
$actividad1=$data['actividad1'];
$actividad2=$data['actividad2'];
$actividad3=$data['actividad3'];
$actividad4=$data['actividad4'];
$actividad5=$data['actividad5'];
$apellidos=$data['apellidos'];
$apellidosRepresentanteLegal=$data['apellidosRepresentanteLegal'];
$apodo=$data['apodo'];
$areaAgopecuaria=$data['areaAgopecuaria'];
$areaAgropecuaria=$data['areaAgropecuaria'];
$barrioParaje=$data['barrioParaje'];
$cantDependientes=$data['cantDependientes'];
$cantFamUp=$data['cantFamUp'];
$catEmplFijos=$data['catEmplFijos'];
$cedula=$data['cedula'];
$cedulaRepresentanteLegal=$data['cedulaRepresentanteLegal'];
$celular=$data['celular'];
$certBuenasPracticas=$data['certBuenasPracticas'];
$certBuenasPracticasCb=$data['certBuenasPracticasCb'];
$certificacionOrganica=$data['certificacionOrganica'];
$certificacionOrganicaCB=$data['certificacionOrganicaCB'];
$codOper=$data['codOper'];
$contratoMercado=$data['contratoMercado'];
$contratoMercadoCB=$data['contratoMercadoCB'];
$correo=$data['correo'];
$direccion=$data['direccion'];
$distrito=$data['distrito'];
$estadoCivil=$data['estadoCivil'];
$fechaIntrod=$data['fechaIntrod'];
$fechaNacimiento=$data['fechaNacimiento'];
$fechaNacimientoC=$data['fechaNacimientoC'];
$fechaNacimientoRepresentante=$data['fechaNacimientoRepresentante'];
$gremioAsociacion=$data['gremioAsociacion'];
$gremioAsociacionCb=$data['gremioAsociacionCb'];
$institucionFinanciamiento=$data['institucionFinanciamiento'];
$intitucionFinanciamientoCB=$data['intitucionFinanciamientoCB'];
$municipio=$data['municipio'];
$nacionalidad=$data['nacionalidad'];
$nacionalidadOtra=$data['nacionalidadOtra'];
if($nacionalidadOtra!=''){
    $nacionalidad=$nacionalidadOtra;
}
$nacionalidadRepresentanteLegal=$data['nacionalidadRepresentanteLegal'];
$nivelEducativo=$data['nivelEducativo'];
$nombres=$data['nombres'];
$nombresRepresentanteLegal=$data['nombresRepresentanteLegal'];
$pasaporte=$data['pasaporte'];
$pasaporteRepresentanteLegal=$data['pasaporteRepresentanteLegal'];
$perteneceAGremio=$data['perteneceAGremio'];
$provincia=$data['provincia'];
$razonSocial=$data['razonSocial'];
$registradoSNTR=$data['registradoSNTR'];
if($registradoSNTR=="1"){
    $registradoSNTR=true;
}else{
    $registradoSNTR=false;
}
$seccion=$data['seccion'];
$seguroAgricola=$data['seguroAgricola'];
$seguroAgricolaCB=$data['seguroAgricolaCB'];
$sexo=$data['sexo'];
$sexoRepresentanteLegal=$data['sexoRepresentanteLegal'];
$subBarrio=$data['subBarrio'];
$telefono=$data['telefono'];
$tipoDePersona=$data['tipoDePersona'];
$viveEnLaParcela=$data['viveEnLaParcela'];
if($viveEnLaParcela=="1"){
    $viveEnLaParcela=true;
}else{
    $viveEnLaParcela = false;
}
$curdate =Carbon::now();
$foto = $data['foto'];
//foto = base64_decode($foto);
$res=DB::insert("INSERT INTO productores_new
(Id,representante,nacionalidad,Sexo,cedula,pasaporte,rnc,
nombre,apellidos,apodo,Direccion,Fecha_Nacimiento,telefono,celular,correo,a1,a2,a3,a4,Imagen,fecha_introd,registradoSNTRA,
gremioAsociacion,nivelEducativo,viveEnlaParcela,institucionFinanciamiento,seguroAgricola,contratoMercado,certificacionOrganica,
certBuenasPracticas,PROV,MUN,REG,DM,SECC,BARRIO,SUBBARRIO,AreaAgropecuaria,estadoCivil)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
[0,0,$nacionalidad,$sexo,$cedula,$pasaporte,$RNC,$nombres,$apellidos,$apodo,$direccion,$fechaNacimiento,
 $telefono,$celular,$correo,$actividad1,$actividad2,$actividad3,$actividad4,$foto,$curdate,$registradoSNTR,$gremioAsociacion,
 $nivelEducativo,$viveEnLaParcela,$institucionFinanciamiento,$seguroAgricola,$contratoMercado,$certificacionOrganica,$certBuenasPracticas,
$provincia,$municipio,'',$distrito,$seccion,$barrioParaje,$subBarrio,$areaAgopecuaria,$estadoCivil]);


if($res>0){
    $id = DB::getPdo()->lastInsertId();
    return response()->json(array('id'=>$id),200,[]);

}
        return $res;
    }

public function ListGeneral($region='',$provincia='',$municipio='',$distrito='',$seccion='',$barrio=''){

if($barrio!=''){
    return $this->ByBarrio($provincia, $municipio,  $distrito,  $seccion, $barrio);
}
if($seccion!=''){
    return $this->BySeccion($provincia, $municipio,  $distrito,  $seccion);
}
if($distrito!=''){
    return $this->ByDistrito($provincia, $municipio,  $distrito);
}
if($municipio!=''){
    return $this->ByMunicipio($provincia, $municipio);
}
if($provincia!=''){
    return $this->ByProvincia($provincia);
  }
  if($region!=''){
      return $this->ByRegion($region);
  }
}


}


