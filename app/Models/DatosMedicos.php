<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class DatosMedicos extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'datos_medicos' ;

    protected $fillable = [
        'user_id',
        'eps',
        'tipo_sangre',   
    ]; 

    public $timestamps = false;
}

