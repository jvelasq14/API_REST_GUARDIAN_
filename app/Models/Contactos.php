<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Contactos extends Model
{
    use HasFactory,HasApiTokens;
    protected $table = 'contactos' ;

    protected $fillable = [
        'user_id',
        'nombre',   
        'telefono'
    ]; 

    public $timestamps = false;
}
