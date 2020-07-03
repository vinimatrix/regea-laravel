<?php

use App\Http\Controllers\Fincas;
use App\Http\Controllers\ImageMakr;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// usage inside a laravel route
Route::get('imagemake/{id}', /*function()
{

    $img = Image::make('../public/regea.jpg');

 $img->text('00117236711', 190, 186, function($font) {
    $font->file(public_path('../public/arial-black.ttf'));
        $font->size(12);
        $font->color('#000000');
        $font->align('center');
       //$font->valign('bottom');
        $font->angle(0);
    });
    $img->text('JUAN DE LOS PALOTES', 195, 150, function($font) {
        $font->file(public_path('../public/arial-black.ttf'));
            $font->size(12);
            $font->color('#000000');
            $font->align('center');
           //$font->valign('bottom');
            $font->angle(0);
        });
        $img->text('12/11/2019', 195, 238, function($font) {
            $font->file(public_path('../public/arial.ttf'));
                $font->size(12);
                $font->color('#000000');
                $font->align('center');
               //$font->valign('bottom');
                $font->angle(0);
            });
            $img->text('12/11/2020', 300, 238, function($font) {
                $font->file(public_path('../public/arial.ttf'));
                    $font->size(12);
                    $font->color('#000000');
                    $font->align('center');
                   //$font->valign('bottom');
                    $font->angle(0);
                });
                $img->text('SAN PEDRO DE MACORIS', 80, 462.8, function($font) {
                    $font->file(public_path('../public/arial.ttf'));
                        $font->size(12);
                        $font->color('#000000');
                        $font->align('center');
                       //$font->valign('bottom');
                        $font->angle(0);
                    });
                    $img->text('1', 25, 503.8, function($font) {
                        $font->file(public_path('../public/arial.ttf'));
                            $font->size(12);
                            $font->color('#000000');
                            $font->align('center');
                           //$font->valign('bottom');
                            $font->angle(0);
                        });
    return $img->response('jpg');
}*/'ImageMakr@makeimage');
Route::get('certificado-finca/{id}','ImageMakr@makeimageFinca');
Route::get('pdf', function (Codedge\Fpdf\Fpdf\Fpdf $fpdf) {

$image = new ImageMakr();
$image = $image->makeimage(1);
//$image = '../public/carnet productor2.png';
$image = 'data:image/png;base64,' . base64_encode($image);
$dataURI= $image;

$img = $img = explode(',',$dataURI,2);
$pic = 'data://text/plain;base64,'. $img[1];

//return $image;
$withoutExt = preg_replace('/\.[^.\s]{3,4}$/', '', $image);
$pdfName = $withoutExt.".pdf";
$fpdf->AddPage();
$fpdf->Image($image,0,0);
$fpdf->AddPage();
$fpdf->Image($image,0,0);
$fpdf->Output();

});
