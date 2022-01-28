<?php

use App\Models\Game;
use App\Support\PdfParser;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;

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

Route::get('test', function () {
    $parser = new PdfParser('storage/6151e57a90b7f5728d37a866_STATS_FGHD21FI.pdf');
    $parser->process();
});
