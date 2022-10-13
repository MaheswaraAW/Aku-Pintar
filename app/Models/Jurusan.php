<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = "jurusan";
    protected $fillable = [
    	'id_kampus',
    	'nama_kampus', 
    	'jurusan', 
    ];
}
