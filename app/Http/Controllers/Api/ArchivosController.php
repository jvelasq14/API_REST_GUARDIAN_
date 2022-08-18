<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archivos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;

class ArchivosController extends Controller
{
    public function create(Request $request){
        $user_id = auth()->user()->id; 
       
        $request->validate([
            "file" => "required",
        ]);

        $file = $request->file('file');
    
    
        $nombre_file = Carbon::now()->timestamp . '.' . $file->getClientOriginalExtension();
       
        Storage::putFileAs('archivos/'.$user_id.'/', new file($file), $nombre_file);
        
        DB::beginTransaction();
        try {
    
          $Archivo = new Archivos;
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
