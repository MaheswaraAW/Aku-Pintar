<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kampus extends Model
{
    use HasFactory;

    protected $table = "kampus";
    protected $fillable = [
    	'nama', 
    	'logo', 
    	'akreditasi', 
    	'status_kampus', 
    	'jenis', 
    	'no_telepon', 
    	'fax', 
    	'alamat', 
    	'link_alamat', 
    	'link_web_kampus', 
    ];
}
