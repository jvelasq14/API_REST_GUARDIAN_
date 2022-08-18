<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Archivos extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'archivos' ;

    protected $fillable = [
        'user_id',
        'file',   
    ]; 

}
