<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Fases extends Model
{
    use HasFactory,HasApiTokens;

    protected $table = 'fases' ;

    protected $fillable = [
        'user_id',
        'nombre',
        'contactos_id',
        'id_archivo',
        'servicio',
    ]; 

    public $timestamps = false;
}
