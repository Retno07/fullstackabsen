<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory;
    use softDeletes;

    protected $primaryKey = 'id_kelas';
    public $table = "kelas";

    protected $fillable = [
        'kode_kelas','nama_kelas'
    ];

    protected $hidden = [

    ];
}
