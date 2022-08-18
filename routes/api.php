<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DatosMedicosController;
use App\Http\Controllers\Api\AlergiasController;
use App\Http\Controllers\Api\PatologiasController;
use App\Http\Controllers\Api\ArchivosController;
use App\Http\Controllers\Api\ContactosController;
use App\Http\Controllers\Api\FasesController;
use App\Http\Controllers\Api\Archivo_vozController;
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
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::group( ['middleware' => ["auth:sanctum"]], function(){
    Route::get('user-profile', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);

    //Tabla Datos medicos
    Route::post("create-Datos-Medicos", [DatosMedicosController::class, "create_Datos_Medicos"]); 
    Route::get("get-datos-medicos", [DatosMedicosController::class, "getDatos_Medicos"]); 
    Route::get("Datos-getBy/{id}", [DatosMedicosController::class, "GetByID"]);

    Route::delete("delete-Datos-medicos/{id}", [DatosMedicosController::class, "delete"]); 
    Route::post("update-Datos-Medicos/{id}", [DatosMedicosController::class, "update"]); 
    //tabla Alergias

    Route::post("create-Alergias", [AlergiasController::class, "create"]); 
    Route::get("get-Alergias", [AlergiasController::class, "get"]); 
    Route::get("Datos-Alergias/{id}", [AlergiasController::class, "GetByID"]);

    Route::delete("delete-Alergias/{id}", [AlergiasController::class, "delete"]); 
    Route::post("update-Alergias/{id}", [AlergiasController::class, "update"]); 

   //table Patologias
   Route::post("create-Patologias", [PatologiasController::class, "create"]); 
   Route::get("get-Patologias", [PatologiasController::class, "get"]); 
   Route::get("Datos-Patologias/{id}", [PalogiasController::class, "GetByID"]);

   Route::delete("delete-Patologias/{id}", [PatologiasController::class, "delete"]); 
   Route::post("update-Patologias/{id}", [PatologiasController::class, "update"]); 

     //table Contactos
     Route::post("create-contactos", [ContactosController::class, "create"]); 
     Route::get("get-contactos", [ContactosController::class, "get"]); 
     Route::get("Datos-contactos/{id}", [ContactosController::class, "GetByID"]);
  
     Route::delete("delete-contactos/{id}", [ContactosController::class, "delete"]); 
     Route::post("update-contactos/{id}", [ContactosController::class, "update"]); 

       //table Fases
   Route::post("create-fases", [FasesController::class, "create"]); 
   Route::get("get-fases", [FasesController::class, "get"]); 
   Route::get("Datos-fases/{id}", [FasesController::class, "GetByID"]);

   Route::delete("delete-fases/{id}", [FasesController::class, "delete"]); 
   Route::post("update-fases/{id}", [FasesController::class, "update"]); 

   Route::post("create-archivos", [ArchivosController::class, "create"]); 
   
   Route::post("create-archivo-voz", [Archivo_vozController::class, "create"]);

   Route::post("update-user", [UserController::class, "update"]); 
   Route::post("update-password", [UserController::class, "updatePassword"]);
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
