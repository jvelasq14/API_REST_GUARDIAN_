<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fases;

class FasesController extends Controller
{
    public function create(Request $request) {
         
        $request->validate([
            "nombre" => "required",
            "contactos_id" => "required",
            "id_archivo" => "required",
            "servicio" => "required",
        ]);
            
      try{
              $user_id = auth()->user()->id;
      
              $Datos = new Fases();    
              $Datos->user_id = $user_id; 
              $Datos->nombre = $request->nombre;
              $Datos->contactos_id = $request->contactos_id;
              $Datos->id_archivo = $request->id_archivo;
              $Datos->servicio = $request->servicio;     
              $Datos->save();
          }catch(\Exception $e){
             $message = $e->getMessage();
             return response()->json(['success'=> false, 'error'=> $message], 500);
          }
                    
              return response([
                  "status" => 1,
                  "msg" => "¡Datos de usuario guardados exitosamente!"
              ]);
          }
          
    
    public function get(Request $request) {
        try{

            $user_id =  auth()->user()->id;

            $DATOS = Fases::where("user_id", $user_id)->get();
    
            return response()->json([
                "status" => 1,
                "msg" => "Fases",
                "data" => $DATOS
            ]);
        }catch(\Exception $e){
             $message = $e->getMessage();
             return response()->json(['success'=> false, 'error'=> $message], 500);
          }
       
    }

     
    public function GetByID($id) {
        try{
        $user_id = auth()->user()->id;
        if( Fases::where( ["id" => $id, "user_id" => $user_id ])->exists() ){            
            $info = Fases::where( ["id" => $id, "user_id" => $user_id ])->get();
            return response()->json([
                "status" => 1,
                "msg" => "Registro encontrado",
                "msg" => $info,
            ], 404);
        }else{            
            return response()->json([
                "status" => 0,
                "msg" => "Registro no encontrado"
            ], 404);
        }
            }catch(\Exception $e){
                $message = $e->getMessage();
                return response()->json(['success'=> false, 'error'=> $message], 500);
     }
    }

    public function update(Request $request, $id){

        try{ 

        $user_id = auth()->user()->id; 

        if ( Fases::where( ["user_id"=>$user_id, "id" => $id] )->exists() ) {                        
            $Datos = Fases::find($id);
            $Datos->nombre = $request->nombre;
            $Datos->contactos_id = $request->contactos_id;
            $Datos->archivo_id = $request->archivo_id;
            $Datos->servicio = $request->servicio;    
            $Datos->save();
            
            return response()->json([
                "status" => 1,
                "msg" => "Actualizado correctamente."
            ]);
        }else{
        
            return response()->json([
                "status" => 0,
                "msg" => "No de encontró el usuario"
            ], 404);
        }  
         }catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
         }
    }

    public function delete($id){
        try{
        $user_id = auth()->user()->id; 
        if( Fases::where( ["id" => $id, "user_id" => $user_id ])->exists() ){
            $info = Fases::where( ["id" => $id, "user_id" => $user_id ])->first();
            $info->delete();
            
            return response()->json([
                "status" => 1,
                "msg" => "Registro eliminado correctamente."
            ]);
        }else{
             
             return response()->json([
                "status" => 0,
                "msg" => "No de encontró el registro"
            ], 404);
        }
    
           }catch(\Exception $e){
               $message = $e->getMessage();
               return response()->json(['success'=> false, 'error'=> $message], 500);
           }
      }
}
