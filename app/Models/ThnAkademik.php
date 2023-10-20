<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThnAkademik extends Model
{
    use HasFactory;
    use softDeletes;

    protected $primaryKey = 'id_akademik';
    public $table = "akademik";

    protected $fillable = [
        'tahun_akademik','nama_semester_akademik'
    ];

    protected $hidden = [

    ];
}
