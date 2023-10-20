<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absen extends Model
{
    use HasFactory;
    // use softDeletes;

    protected $primaryKey = 'id_absen';
    public $table = "absen";

    protected $fillable = [
        'nim_mahasiswa_absen','id_log_absen','pertemuan_log_absen','keterangan_log_absen'
    ];

    protected $hidden = [

    ];
}
