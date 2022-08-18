<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Alergias extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'alergias' ;

    protected $fillable = [
        'user_id',
        'alergia',   
    ]; 

    public $timestamps = false;
}
