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
        return DB::table('fincas')->where('provinciaEstablecimiento',$provincia,true)
        ->where('municipioEstablecimiento',$municipio)->get();
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

    public function get($finca){}
    public function create(Request $request){
        $data = $request->json()->all();
        $nombreEstablecimiento = $data['nombreEstablecimiento'];
        $RNC = $data['RNC'];
        $aguaPotable = $data['aguaPotable'];
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
$estructuraConducAgua = $data['estructuraConducAgua'];
$fechaNacimietoRepresentanteLegal = $data['fechaNacimietoRepresentanteLegal'];
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
$nombreEstablecimiento = $data['nombreEstablecimiento'];
$nombresRepresentanteLegal = $data['nombresRepresentanteLegal'];
$nort = $data['nort'];
$observaciones = $data['observaciones'];
$ordeniaApoyadoBecerros = $data['ordeniaApoyadoBecerros'];
$parcelaReformaAgraria = $data['parcelaReformaAgraria'];
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
    ?,
    )',
     [0,0,$curdate,$curdate,'0',$nombreEstablecimiento,$direccionEstablecimiento,$provinciaEstablecimiento,$municipioEstablecimiento,$distrito,$seccion,$barrioParaje,'',
       $latitud,$longitud,$altitud,$areaProdAnimal,$areaProdAgricola,$areaAcuicultura,$areaBosqueOForestal,$areaInfraEstructura,$areaTotal,$clasificacion,$cantFamiliaresParticipanProd,
       $cantEmpleadosFijos,$mercadoDestinoProduccion,$parcelaReformaAgraria,$formaPosesion,$formaUsufructo,$tipoSuperficie,$fuenteAbastAgua,$metodoAbastAgua,
    $estructuraConducAgua,$sistemaRiego,$manoObraSuficiente, $tipoViaAcceso,$energiaElectrica,$aguaPotable,$letrina,$centroSaludCerca,$nivelacionLaserTerreno,$limitantesParcela,
    $observaciones,$cantCabezaGanado,$cantTareasPasturas,$cantPotreros,$cantVacasOrdenioProd,$cantVacasHorras,$cantNovAniojas,$canBecerras,$cantBecerros,
    $cantNovillasPeniadasyMonta,$cantOrdeniosDia,$ordeniaApoyadoBecerros,$prodLtsLecheDiaAnt,$cantVacascnBecerros,$cantBecerrosDetestado,$cantNovillosEngorde,
    $cantCabezasPorcinas,$cantCabezasOvinoCaprino,$cantPadrotes,$cantMadresCaprino,$cantAves,$cantGallinasPonedoras,$cantGallinasEngorde,
    $cantReproductorasPesadas,$cantReproductorasLivianas,$cantConejos,$cantMadresCuniculas,$cantColmenaresRustica,$cantColmenaresModerna,
    $nombresRepresentanteLegal,$apellidosRepresentanteLegal,$cedulaRepresentanteLegal,$generoRepresentanteLegal,$nacionalidadRepresentanteLegal,$pasaporteRepresentanteLegal,
    $fechaNacimietoRepresentanteLegal,$razonSocial,$RNC,'',$areaVarias,$finalidadPrincipal,$finalidad1,$finalidad2,$finalidad3,$finalidad4,
    '',$cantNovillosAniojos,'',$institucionFinanciamiento,$seguroAgricola,$contratoMercado,$certificacionOrganica,$certBuenasPracticas]);
if($sql>0){
    $id = DB::getPdo()->lastInsertId();
    $u =DB::update("update fincas set CUE = DB::raw('CONCAT('214',provinciaEstablecimiento,municipioestablecimiento,LPAD(ID,6,0))') where ID = ?", [$id]);
    if($u>0){
        return response()->json($data);
    }
}else{
    return "error";
}
}

    }
    public function update($data,$finca){}
    public function detele($finca){}

}
