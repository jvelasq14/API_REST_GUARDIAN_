<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Patologias extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'patologias' ;

    protected $fillable = [
        'user_id',
        'patologia',   
    ]; 

    public $timestamps = false;
}
