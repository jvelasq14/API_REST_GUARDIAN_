<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alergias;

class AlergiasController extends Controller
{
    public function create(Request $request) {
         
        $request->validate([
            "alergia" => "required",
        ]);
            
      try{
              $user_id = auth()->user()->id;
      
              $Datos = new Alergias();    
              $Datos->user_id = $user_id; 
              $Datos->alergia = $request->alergia;
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

            $DATOS = Alergias::where("user_id", $user_id)->get();
    
            return response()->json([
                "status" => 1,
                "msg" => "Alergias",
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
        if( Alergias::where( ["id" => $id, "user_id" => $user_id ])->exists() ){            
            $info = Alergias::where( ["id" => $id, "user_id" => $user_id ])->get();
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

        if ( Alergias::where( ["user_id"=>$user_id, "id" => $id] )->exists() ) {                        
            $Datos = Alergias::find($id);   
            $Datos->alergia = $request->alergia;    
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
        if( Alergias::where( ["id" => $id, "user_id" => $user_id ])->exists() ){
            $info = Alergias::where( ["id" => $id, "user_id" => $user_id ])->first();
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
