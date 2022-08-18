<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArchivoVoz;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;

class Archivo_vozController extends Controller
{
    public function create(Request $request){
        $user_id = auth()->user()->id; 
       
        $request->validate([
            "file" => "required",
        ]);

        $file = $request->file('file');
        //dd($request->file('voz'));
    
    
        $nombre_file = Carbon::now()->timestamp . '.' . $file->getClientOriginalExtension();
       
        Storage::putFileAs('archivos_voz/'.$user_id.'/', new file($file), $nombre_file);
        
        DB::beginTransaction();
        try {
    
          $Archivo = new ArchivoVoz;
          $Archivo->file = $nombre_file;
          $Archivo->user_id  = $user_id;
          $Archivo->save();
       
          DB::commit();
    
        } catch (\Exception $e) {
          DB::rollback();
          $message = $e->getMessage();
          return response()->json(['success'=> false, 'error'=> $message], 500);
        }
        return response()->json($Archivo, 201);
      }
}
