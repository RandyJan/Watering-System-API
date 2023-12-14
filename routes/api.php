<?php
use App\Http\Controllers\WateringControler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/sendData', [WateringControler::class, 'store']);
Route::post('/getData', [WateringControler::class,'show']);
Route::get('/getStatus', [WateringControler::class,'status']);
Route::post('/switch', [WateringControler::class,'switch']);
Route::get('/sensorStatus', [WateringControler::class,'sensor']);
Route::post('/setSensorStatus', [WateringControler::class,'setSensor']);
Route::get('/waterUsage',[WateringControler::class,'computeUsage']);

