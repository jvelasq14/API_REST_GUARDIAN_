<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class ArchivoVoz extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'archivo_vozs' ;

    protected $fillable = [
        'user_id',
        'voz',      
    ]; 
}
