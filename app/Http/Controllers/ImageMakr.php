<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Codedge\Fpdf\Facades\Fpdf;

class ImageMakr extends Controller
{
    //
    public function makeimage($id)
    {
        $prod = DB::raw("SELECT p.*,m.TOPONIMIA as MUNICIPIO from productores_new as p
        LEFT JOIN muncenso2010 as m ON p.PROV=m.PROV AND p.MUN= m.MUN WHERE p.Id = $id");
        $prod = DB::select($prod);

        if ($prod) {
            $prod = $prod[0];
            /************Tomar rl fondo*********** */
            $img = Image::make(public_path('carnet productor2.png'));
/**********************************************CEDULA******************** */
            $img->text($prod->cedula, 365, 278, function ($font) {
                $font->file(public_path('Times New Roman 400.ttf'));
                $font->size(8);
                $font->color('#000000');
                //$font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });
            /****************NOMBRE y APELLIDO******************** */
            $img->text($prod->nombre .' '. $prod->apellidos, 362, 217, function ($font) {
                $font->file(public_path('Times New Roman 400.ttf'));
                $font->size(8);
                $font->color('#000000');
                //$font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });
            /*************FECHA AUTORIZACION*********** */
            $img->text('12/11/2020', 587, 218, function ($font) {
                $font->file(public_path('Times New Roman 400.ttf'));
                $font->size(8);
                $font->color('#000000');
                //$font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });
            $img->text('12/11/2021', 587, 276, function ($font) {
                $font->file(public_path('Times New Roman 400.ttf'));
                $font->size(8);
                $font->color('#000000');
               // $font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });
            $img->text($prod->municipio.', '.$prod->provincia, 369, 603, function ($font) {
                $font->file(public_path('Times New Roman 400.ttf'));
                $font->size(8);
                $font->color('#000000');
                //$font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });
            $img->text('1', 653, 604, function ($font) {
                $font->file(public_path('../public/arial.ttf'));
                $font->size(12);
                $font->color('#000000');
                $font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });
            $img = $img->resize(1420,900);

/****************************************************** */



          return $img->response('png');
        }else{
            return $prod;
        }

    }
    public function makeimageFinca($id)
    {
        $prod = DB::raw("SELECT
        p.apellidos,
        p.nombre,
        f.finalidadPrincipal as a1,
        p.cedula,
        f.provinciaEstablecimiento,
        f.municipioEstablecimiento,
        LPAD(f.ID,6,0) as ID,
        f.nombreEstablecimiento,
        DATE(DATE_ADD(f.fechaIntrod,INTERVAL 1 YEAR)) as fechaIntrod
        FROM
        fincas AS f
        LEFT JOIN productores_new AS p ON f.cedulaRepresentanteLegal = p.cedula
        WHERE
        f.ID = $id");
        $prod = DB::select($prod);

        if ($prod) {
            $prod = $prod[0];
            $img = Image::make(public_path('certificado.png'));

            $img->text($prod->cedula, 86, 432, function ($font) {
                $font->file(public_path('trebuc.ttf'));
                $font->size(20);
                $font->color('#000000');
                //$font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });
            $img->text($prod->nombre .' '. $prod->apellidos, 87, 370, function ($font) {
                $font->file(public_path('TREBUCBD.ttf'));
                $font->size(26);
                $font->color('#000000');
                //$font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });
            /************CUE************ */
            $img->text('214', 734, 391, function ($font) {
                $font->file(public_path('TREBUCBD.ttf'));
                $font->size(38);
                $font->color('#000000');
                //$font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });
            $img->text($prod->provinciaEstablecimiento, 816, 391, function ($font) {
                $font->file(public_path('TREBUCBD.ttf'));
                $font->size(24);
                $font->color('#000000');
                //$font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });
            $img->text($prod->municipioEstablecimiento, 855, 391, function ($font) {
                $font->file(public_path('TREBUCBD.ttf'));
                $font->size(24);
                $font->color('#000000');
                //$font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });
            $img->text($prod->ID, 894, 391, function ($font) {
                $font->file(public_path('TREBUCBD.ttf'));
                $font->size(28);
                $font->color('#000000');
                //$font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });
            /************************************************** */
            /******************ACTIVIDAD********************** */
            $img->text($prod->a1, 553, 470, function ($font) {
                $font->file(public_path('TREBUCBD.ttf'));
                $font->size(22);
                $font->color('#000000');
                $font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });
            /********************************************** */
            /*******************NOMBRE ESTABLECIMIENTO***************************/
            $img->text($prod->nombreEstablecimiento, 88, 528, function ($font) {
                $font->file(public_path('TREBUCBD.ttf'));
                $font->size(26);
                $font->color('#000000');
                //$font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });
            /*************************************************************** */
            setlocale(LC_ALL, 'es_ES');
            Carbon::setLocale('es');
            $mes = Carbon::parse($prod->fechaIntrod)->isoFormat('LL');
            $img->text($mes, 89, 630, function ($font) {
                $font->file(public_path('TREBUCBD.ttf'));
                $font->size(24);
                $font->color('#000000');
                //$font->align('center');
                //$font->valign('bottom');
                $font->angle(0);
            });

            return $img->response('jpg');
        }else{
            return $prod;
        }
    }




}
