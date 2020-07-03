<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
/**
 * Class description
 *
 * @author  Vinicio Mendez
 * @license MIT (or other licence)
 */
class Fincas extends Controller
{
    //FUNCIONES PARA CONSULTAS VARIAS
    public function Index(){}
    public function ByRegion(string $region){
        return DB::table('fincas')->where('REG',$region)->get();
    }
    public function ByProvincia(string $provincia){

        return DB::table('fincas')->where('provinciaEstablecimiento',$provincia)->get();
    }
    public function ByMunicipio(string $provincia,string $municipio){
        $sql = DB::raw("SELECT * FROM fincas WHERE municipioEstablecimiento= '$municipio' AND provinciaEstablecimiento ='$provincia'");
        return DB::select($sql);
    }
    public function ByDistrito(string $provincia,string $municipio,string $distrito){}
    public function BySeccion(string $provincia,string $municipio,string $distrito,string $seccion){}
    public function ByBarrio(string $provincia,string $municipio,string $distrito,string $seccion,string $barrio){}
    public function ByMultiProvincia($provincias){}
    public function ByMultiMunicipios($data){}


    ///////////////////////////////////////

public function ListGeneral($region='',$provincia='',$municipio='',$distrito='',$seccion='',$barrio=''){
    if ($barrio!='') {
        return $this->ByBarrio($provincia, $municipio, $distrito, $seccion, $barrio);
    }
    if ($seccion!='') {
        return $this->BySeccion($provincia, $municipio, $distrito, $seccion);
    }
    if ($distrito!='') {
        return $this->ByDistrito($provincia, $municipio, $distrito);
    }
    if ($municipio!='') {
        return $this->ByMunicipio($provincia, $municipio);
    }
    if ($provincia!='') {
        return $this->ByProvincia($provincia);
    }
    if ($region!='') {
        return $this->ByRegion($region);
    }
}
////////////////////////////////////////////////

public function listActividades(){
    return DB::table('actividades')->get();

}
    ///////CRUD//////////


        public function create(Request $request){
        $data = $request->json()->all();
        $nombreEstablecimiento = $data['nombreEstablecimiento'];
        $RNC = $data['RNC'];
        $aguaPotable = $data['aguaPotable'];
        if($aguaPotable=="1"){
            $aguaPotable = true;
        }else{
            $aguaPotable = false;
        }
        $altitud = $data['altitud'];
        $apellidosRepresentanteLegal = $data['apellidosRepresentanteLegal'];
        $areaAcuicultura = $data['areaAcuicultura'];
        $areaAgropecuaria = $data['areaAgropecuaria'];
        $areaBosqueOForestal = $data['areaBosqueOForestal'];
        $areaInfraEstructura = $data['areaInfraEstructura'];
        $areaProdAgricola = $data['areaProdAgricola'];
        $areaProdAnimal = $data['areaProdAnimal'];
        $areaTotal = $data['areaTotal'];
        $areaVarias = $data['areaVarias'];
        $barrioParaje = $data['barrioParaje'];
        $canBecerras = $data['canBecerras'];
        $cantAves = $data['cantAves'];
        $cantBecerros = $data['cantBecerros'];
        $cantBecerrosDetestado = $data['cantBecerrosDetestado'];
        $cantCabezaGanado = $data['cantCabezaGanado'];
        $cantCabezasOvinoCaprino = $data['cantCabezasOvinoCaprino'];
        $cantCabezasPorcinas = $data['cantCabezasPorcinas'];
        $cantColmenaresModerna = $data['cantColmenaresModerna'];
        $cantColmenaresRustica = $data['cantColmenaresRustica'];
        $cantConejos = $data['cantConejos'];
        $cantDependientes = $data['cantDependientes'];
        $cantEmpleadosFijos = $data['cantEmpleadosFijos'];
        $cantFamUp = $data['cantFamUp'];
        $cantFamiliaresParticipanProd = $data['cantFamiliaresParticipanProd'];
        $cantGallinasEngorde = $data['cantGallinasEngorde'];
        $cantGallinasPonedoras = $data['cantGallinasPonedoras'];
        $cantMadresCaprino = $data['cantMadresCaprino'];
        $cantMadresCuniculas = $data['cantMadresCuniculas'];
        $cantMadresPorcinas = $data['cantMadresPorcinas'];
        $cantNovAniojas = $data['cantNovAniojas'];
        $cantNovillasPeniadasyMonta = $data['cantNovillasPeniadasyMonta'];
        $cantNovillosAniojos = $data['cantNovillosAniojos'];
        $cantNovillosEngorde = $data['cantNovillosEngorde'];
        $cantOrdeniosDia = $data['cantOrdeniosDia'];
        $cantPadrotes = $data['cantPadrotes'];
        $cantPotreros = $data['cantPotreros'];
        $cantReproductorasLivianas = $data['cantReproductorasLivianas'];
        $cantReproductorasPesadas = $data['cantReproductorasPesadas'];
        $cantTareasPasturas = $data['cantTareasPasturas'];
        $cantVacasHorras = $data['cantVacasHorras'];
        $cantVacasOrdenioProd = $data['cantVacasOrdenioProd'];
        $cantVacascnBecerros = $data['cantVacascnBecerros'];
        $catEmplFijos = $data['catEmplFijos'];
        $cedulaRepresentanteLegal = $data['cedulaRepresentanteLegal'];
        $centroSaludCerca = $data['centroSaludCerca'];
        if($centroSaludCerca=="1"){
            $centroSaludCerca = true;
        }else{
            $centroSaludCerca = false;
        }
        $certBuenasPracticas = $data['certBuenasPracticas'];
        $certBuenasPracticasCb = $data['certBuenasPracticasCb'];
        $certificacionOrganica = $data['certificacionOrganica'];
        $certificacionOrganicaCB = $data['certificacionOrganicaCB'];
        $clasificacion = $data['clasificacion'];
        $clasificacionDetai = $data['clasificacionDetai'];
        $clasificacionDetail = $data['clasificacionDetail'];

if($clasificacion=="otra"){
    $clasificacion = $clasificacionDetai;
}
$contratoMercado = $data['contratoMercado'];
$contratoMercadoCB = $data['contratoMercadoCB'];
$coordLat = $data['coordLat'];
$coordLon = $data['coordLon'];
$direccionEstablecimiento = $data['direccionEstablecimiento'];
$distrito = $data['distrito'];
$east = $data['east'];
$energiaElectrica = $data['energiaElectrica'];
if($energiaElectrica=="1"){
    $energiaElectrica = true;
}else{
    $energiaElectrica = false;
}
$estructuraConducAgua = $data['estructuraConducAgua'];
$fechaNacimietoRepresentanteLegal = '2020-06-24 00:00:00';//$data['fechaNacimietoRepresentanteLegal'];
$finalidad1 = $data['finalidad1'];
$finalidad2 = $data['finalidad2'];
$finalidad3 = $data['finalidad3'];
$finalidad4 = $data['finalidad4'];
$finalidadPrincipal = $data['finalidadPrincipal'];
$formaPosesion = $data['formaPosesion'];
$formaUsufructo = $data['formaUsufructo'];
$fuenteAbastAgua = $data['fuenteAbastAgua'];
$gLat = $data['gLat'];
$gLon = $data['gLon'];
$generoRepresentanteLegal = $data['generoRepresentanteLegal'];
$institucionFinanciamiento = $data['institucionFinanciamiento'];
$institucionFinanciamientoCB = $data['institucionFinanciamientoCB'];
$institucionFinanciamientoCb = $data['institucionFinanciamientoCb'];
$latitud = $data['latitud'];
$latitudUTM = $data['latitudUTM'];
$letrina = $data['letrina'];
if($letrina=="1"){
    $letrina = true;
}else{
    $letrina = false;
}
$lim1 = $data['lim1'];
$lim2 = $data['lim2'];
$lim3 = $data['lim3'];
$lim4 = $data['lim4'];
$lim5 = $data['lim5'];
$lim6 = $data['lim6'];
$lim7 = $data['lim7'];
$lim8 = $data['lim8'];
$lim9 = $data['lim9'];
$lim10 = $data['lim10'];
$lim11 = $data['lim11'];
$limitantesParcela = $data['limitantesParcela'];

if($lim1){
    $lim1 = "Grandes problemas de erosión";
}
if($lim2){
    $lim2 = "Restricción del desarrollo radicular";
}
if($lim3){
    $lim3 = "Mal drenada o fácil de inundar";
}
if($lim4){
    $lim4 = "Baja retención de humedad";
}
if($lim5){
    $lim5 = "Clima local desfavorable";
}
if($lim6){
    $lim6 = "Pedregosidad en el suelo y superficie";
}
if($lim7){
    $lim7 = "Sin agua";
}
if($lim8){
    $lim8 = "Muy quebrada";
}
if($lim9){
    $lim9 = "No tiene problema";
}
$limitantesParcela = $limitantesParcela . ", " . $lim1 . ", " . $lim2 . ' ,' . $lim3 . ", " . $lim4 . ' ,' . $lim5 . ", " . $lim6 . ' ,' . $lim7 . ", " . $lim8 . ' ,' . $lim9 . ", "  . $lim11;
$longitud = $data['longitud'];
$longitudUTM = $data['longitudUTM'];
$manoObraSuficiente = $data['manoObraSuficiente'];
$mercadoDestinoProduccion = $data['mercadoDestinoProduccion'];
$mercadoDestinoProduccionOtra = $data['mercadoDestinoProduccionOtra'];
$mercadoDestinoProduccionOtro = $data['mercadoDestinoProduccionOtro'];
$metodoAbastAgua = $data['metodoAbastAgua'];
$minutosLat = $data['minutosLat'];
$minutosLon = $data['minutosLon'];
$municipioEstablecimiento = $data['municipioEstablecimiento'];
$nacionalidadRepresentanteLegal = $data['nacionalidadRepresentanteLegal'];
$nacionalidadRepresentanteLegalOtra = $data['nacionalidadRepresentanteLegalOtra'];

if($nacionalidadRepresentanteLegal=="otra"){
    $nacionalidadRepresentanteLegal = $data->cedulaRepresentanteLegalOtra;
}
$nivelacionLaserTerreno = $data['nivelacionLaserTerreno'];
if($nivelacionLaserTerreno=="1"){
    $nivelacionLaserTerreno= true;
}else{
    $nivelacionLaserTerreno = false;
}
$nombreEstablecimiento = $data['nombreEstablecimiento'];
$nombresRepresentanteLegal = $data['nombresRepresentanteLegal'];
$nort = $data['nort'];
$observaciones = $data['observaciones'];
$ordeniaApoyadoBecerros = $data['ordeniaApoyadoBecerros'];
$parcelaReformaAgraria = $data['parcelaReformaAgraria'];
if($parcelaReformaAgraria=="1"){
    $parcelaReformaAgraria = true;
}else{
    $parcelaReformaAgraria = false;
}
$pasaporteRepresentanteLegal = $data['pasaporteRepresentanteLegal'];
$prodLtsLecheDiaAnt = $data['prodLtsLecheDiaAnt'];
$provinciaEstablecimiento = $data['provinciaEstablecimiento'];
$razonSocial = $data['razonSocial'];
$seccion = $data['seccion'];
$segundosLat = $data['segundosLat'];
$segundosLon = $data['segundosLon'];
$seguroAgricola = $data['seguroAgricola'];
$seguroAgricolaCB = $data['seguroAgricolaCB'];
$sistemaRiego = $data['sistemaRiego'];
$subBarrio = $data['subBarrio'];
$tipoCoordenada = $data['tipoCoordenada'];
$tipoMedida = $data['tipoMedida'];
$tipoSuperficie = $data['tipoSuperficie'];
$tipoViaAcceso = $data['tipoViaAcceso'];
$direccionEstablecimiento = $data['direccionEstablecimiento'];
$provinciaEstablecimiento = $data['provinciaEstablecimiento'];

$curdate =Carbon::now();
if ($cedulaRepresentanteLegal!=''&& $nombreEstablecimiento!='') {

    $sql = DB::insert('insert into fincas (
    ID,
    CUE,
    fechaIntrod,
    fechaModificacion,
    codigoOperador,
    nombreEstablecimiento,
    direccionEstablecimiento,
    provinciaEstablecimiento,
    municipioEstablecimiento,
    distrito,
    seccion,
    barrioParaje,
    subBarrio,
    latitud,
    longitud,
    altitud,
    areaProdAnimal,
    areaProdAgricola,
    areaAcuicultura,
    areaBosqueOForestal,
    areaInfraEstructura,
    areaTotal,
    clasificacion,
    cantFamiliaresParticipanProd,
    cantEmpleadosFijos,
    mercadoDestinoProduccion,
    parcelaReformaAgraria,
    formaPosesionL,
    formaUsufructo,
    tipoSUperficie,
    fuenteAbastAgua,
    metodoAbastAgua,
    estructuraConducAgua,
    sistemaRiego,
    manoObraSuficiente,
    tipoViaAcceso,
    energiaElectrica,
    aguaPotable,
    letrina,
    centroSaludCerca,
    nivelacionLaserTerreno,
    limitantesParcela,
    observaciones,
    cantCabezaGanado,
    cantTareasPasturas,
    cantPotreros,
    cantVacasOrdenioProd,
    cantVacasHorras,
    cantNovAniojas,
    canBecerras,
    cantBecerros,
    cantNovillasPeniadasyMonta,
    cantOrdeniosDia,
    ordeniaApoyadoBecerros,
    prodLtsLecheDiaAnt,
    cantVacascnBecerros,
    cantBecerrosDetestado,
    cantNovillosENgorde,
    cantCabezasPorcinas,
    cantMadresPorcinas,
    cantCabezasOvinoCaprino,
    cantPadrotes,
    cantMadresCaprino,
    cantAves,
    cantGallinasPonedoras,
    cantGallinasEngorde,
    cantReproductorasPesadas,
    cantReproductorasLivianas,
    cantConejos,
    cantMadresCuniculas,
    cantColmenaresRustica,
    cantColmenaresModerna,
    nombresRepresentanteLegal,
    apellidosRepresentanteLegal,
    cedulaRepresentanteLegal,
    generoRepresentanteLegal,
    nacionalidadRepresentanteLegal,
    pasaporteRepresentanteLegal,
    fechaNacimietoRepresentanteLegal,
    razonSocialRepresentanteLegal,
    RNC,
    Institucion,
    areaVarias,
    finalidadPrincipal,
    finalidad1,
    finalidad2,
    finalidad3,
    finalidad4,
    razonSOcial,
    cantNovillosAniojos,
    REG,
    institucionFInanciamiento,
    seguroAgricola,
    contratoMercado,
    certificacionOrganica,
    certificadoBuenasPracticas
    ) values (?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?
    )',
     [0,0,$curdate,$curdate,'0',$nombreEstablecimiento,$direccionEstablecimiento,$provinciaEstablecimiento,$municipioEstablecimiento,$distrito,$seccion,$barrioParaje,'',
       $latitud,$longitud,$altitud,$areaProdAnimal,$areaProdAgricola,$areaAcuicultura,$areaBosqueOForestal,$areaInfraEstructura,$areaTotal,$clasificacion,$cantFamiliaresParticipanProd,
       $cantEmpleadosFijos,$mercadoDestinoProduccion,$parcelaReformaAgraria,$formaPosesion,$formaUsufructo,$tipoSuperficie,$fuenteAbastAgua,$metodoAbastAgua,
    $estructuraConducAgua,$sistemaRiego,$manoObraSuficiente, $tipoViaAcceso,$energiaElectrica,$aguaPotable,$letrina,$centroSaludCerca,$nivelacionLaserTerreno,$limitantesParcela,
    $observaciones,$cantCabezaGanado,$cantTareasPasturas,$cantPotreros,$cantVacasOrdenioProd,$cantVacasHorras,$cantNovAniojas,$canBecerras,$cantBecerros,
    $cantNovillasPeniadasyMonta,$cantOrdeniosDia,$ordeniaApoyadoBecerros,$prodLtsLecheDiaAnt,$cantVacascnBecerros,$cantBecerrosDetestado,$cantNovillosEngorde,
    $cantCabezasPorcinas,$cantMadresPorcinas,$cantCabezasOvinoCaprino,$cantPadrotes,$cantMadresCaprino,$cantAves,$cantGallinasPonedoras,$cantGallinasEngorde,
    $cantReproductorasPesadas,$cantReproductorasLivianas,$cantConejos,$cantMadresCuniculas,$cantColmenaresRustica,$cantColmenaresModerna,
    $nombresRepresentanteLegal,$apellidosRepresentanteLegal,$cedulaRepresentanteLegal,$generoRepresentanteLegal,$nacionalidadRepresentanteLegal,$pasaporteRepresentanteLegal,
    $fechaNacimietoRepresentanteLegal,$razonSocial,$RNC,'',$areaVarias,$finalidadPrincipal,$finalidad1,$finalidad2,$finalidad3,$finalidad4,
    '',$cantNovillosAniojos,'',$institucionFinanciamiento,$seguroAgricola,$contratoMercado,$certificacionOrganica,$certBuenasPracticas]);
if($sql>0){
    $id = DB::getPdo()->lastInsertId();
    $raw = DB::raw( "SELECT CONCAT('214',provinciaEstablecimiento,municipioestablecimiento,LPAD(ID,6,0)) as CUE from fincas WHERE ID='$id'");
    $raw = DB::select($raw);
    $raw = $raw[0];
    //echo $raw->CUE;
    $u =DB::update("update fincas set CUE = '$raw->CUE' where ID = ?", [$id]);
    if($u>0){
       $data = DB::table('fincas')->where('ID',$id)->get();
        return response()->json($data[0]);
    }
}else{
    return "error";
}
}

    }
    public function update($data,$finca){}
    public function detele($finca){}


    public function get($id){
     $sql = DB::raw("SELECT
     fincas.*,
     provcenso2010.TOPONIMIA as PROVINCIA,
     muncenso2010.TOPONIMIA as MUNICIPIO,
     dmcenso2010.TOPONIMIA as DISTRITO,
     seccenso2010.TOPONIMIA as SECCION,
     bpcenso2010.TOPONIMIA as BARRIO,
     productores_new.apellidos,
     productores_new.apodo,
     productores_new.telefono,
     productores_new.celular,
     productores_new.correo,
     productores_new.Fecha_Nacimiento,
     productores_new.cedula,
     productores_new.nombre

     FROM
     fincas
     INNER JOIN provcenso2010 ON fincas.provinciaEstablecimiento = provcenso2010.PROV
     INNER JOIN muncenso2010 ON fincas.provinciaEstablecimiento = muncenso2010.PROV AND fincas.municipioEstablecimiento = muncenso2010.MUN
     INNER JOIN dmcenso2010 ON fincas.provinciaEstablecimiento = dmcenso2010.PROV AND fincas.municipioEstablecimiento = dmcenso2010.MUN AND fincas.distrito = dmcenso2010.DM
     INNER JOIN seccenso2010 ON fincas.provinciaEstablecimiento = seccenso2010.PROV AND fincas.municipioEstablecimiento = seccenso2010.MUN AND fincas.distrito = seccenso2010.DM AND fincas.seccion = seccenso2010.SECC
     LEFT JOIN bpcenso2010 ON fincas.provinciaEstablecimiento = bpcenso2010.PROV AND fincas.municipioEstablecimiento = bpcenso2010.MUN AND fincas.distrito = bpcenso2010.DM AND fincas.seccion = bpcenso2010.SECC AND fincas.barrioParaje = bpcenso2010.BP
     LEFT JOIN productores_new ON fincas.cedulaRepresentanteLegal = productores_new.cedula
     WHERE
     fincas.ID =  $id
     ");
     //echo $sql;
     $res = DB::select($sql);
     if($res){
        return response()->json($res[0],200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
     }else{
       return $sql;
     }
    }

    public function getfincasWithProd($provincia="",$municipio="",$region="",$barrio="",$distrito="",$seccion=""){
        if($region!=""){
            $region = "WHERE fincas.REG= $region";
        }
        if($provincia!=""){
            $provincia = " AND fincas.provinciaEstablecimiento=$provincia";
        }
        if($municipio!=""){
            $municipio = " AND fincas.lmunicipioEstablecimiento=$municipio";
        }
        /**TODO***
         *
         * TRANSFORMACIONES DEL QUERY PARA LAS DEMAS VARIABLES
        */
      $sql = DB::raw("SELECT
     fincas.*,
     provcenso2010.TOPONIMIA as PROVINCIA,
     muncenso2010.TOPONIMIA as MUNICIPIO,
     dmcenso2010.TOPONIMIA as DISTRITO,
     seccenso2010.TOPONIMIA as SECCION,
     bpcenso2010.TOPONIMIA as BARRIO,
     productores_new.apellidos,
     productores_new.apodo,
     productores_new.telefono,
     productores_new.celular,
     productores_new.correo,
     productores_new.Fecha_Nacimiento,
     productores_new.cedula,
     productores_new.nombre

     FROM
     fincas
     INNER JOIN provcenso2010 ON fincas.provinciaEstablecimiento = provcenso2010.PROV
     INNER JOIN muncenso2010 ON fincas.provinciaEstablecimiento = muncenso2010.PROV AND fincas.municipioEstablecimiento = muncenso2010.MUN
     INNER JOIN dmcenso2010 ON fincas.provinciaEstablecimiento = dmcenso2010.PROV AND fincas.municipioEstablecimiento = dmcenso2010.MUN AND fincas.distrito = dmcenso2010.DM
     INNER JOIN seccenso2010 ON fincas.provinciaEstablecimiento = seccenso2010.PROV AND fincas.municipioEstablecimiento = seccenso2010.MUN AND fincas.distrito = seccenso2010.DM AND fincas.seccion = seccenso2010.SECC
     LEFT JOIN bpcenso2010 ON fincas.provinciaEstablecimiento = bpcenso2010.PROV AND fincas.municipioEstablecimiento = bpcenso2010.MUN AND fincas.distrito = bpcenso2010.DM AND fincas.seccion = bpcenso2010.SECC AND fincas.barrioParaje = bpcenso2010.BP
     LEFT JOIN productores_new ON fincas.cedulaRepresentanteLegal = productores_new.cedula
    $region $provincia $municipio");
    $res = DB::select($sql);
     return response()->json($res,200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }

}
