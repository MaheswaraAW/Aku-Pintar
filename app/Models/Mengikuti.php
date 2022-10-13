<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mengikuti extends Model
{
    use HasFactory;

    protected $table = "mengikuti";
    protected $fillable = [
    	'id_user',
    	'id_kampus',
    	'nama_kampus', 
    	'status_mengikuti', 
    ];
}
