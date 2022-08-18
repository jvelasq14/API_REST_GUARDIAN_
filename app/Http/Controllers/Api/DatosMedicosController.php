<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DatosMedicos;

class DatosMedicosController extends Controller
{
    public function create_Datos_Medicos(Request $request) {
         
        $request->validate([
            "eps" => "required",
            "tipo_sangre" => "required",
        ]);
            
      try{
              $user_id = auth()->user()->id;
      
              $Datos = new DatosMedicos();    
              $Datos->user_id = $user_id; 
              $Datos->eps = $request->eps;
              $Datos->tipo_sangre = $request->tipo_sangre;
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
          
    
    public function getDatos_Medicos(Request $request) {
        try{

            $user_id =  auth()->user()->id;

            $DATOS = DatosMedicos::where("user_id", $user_id)->get();
    
            return response()->json([
                "status" => 1,
                "msg" => "Datos Medicos",
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
        if( DatosMedicos::where( ["id" => $id, "user_id" => $user_id ])->exists() ){            
            $info = DatosMedicos::where( ["id" => $id, "user_id" => $user_id ])->get();
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

        $request->validate([
            "eps" => "required",
            "tipo_sangre" => "required",
        ]);

        try{ 

        $user_id = auth()->user()->id; 

        

        if ( DatosMedicos::where( ["user_id"=>$user_id, "id" => $id] )->exists() ) {                        
            $Datos_Medicos_Registro = DatosMedicos::find($id);
            $Datos_Medicos_Registro->eps = $request->eps;   
            $Datos_Medicos_Registro->tipo_sangre = $request->tipo_sangre;
            $Datos_Medicos_Registro->save();
            
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
        if( DatosMedicos::where( ["id" => $id, "user_id" => $user_id ])->exists() ){
            $info = DatosMedicos::where( ["id" => $id, "user_id" => $user_id ])->first();
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