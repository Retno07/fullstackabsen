<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LogBook extends Model
{
    use HasFactory;
    use softDeletes;

    protected $primaryKey = 'id_identity';
    public $table = "identity_log_book";

    protected $fillable = [
        'id_kelas_identity','id_prodi_identity','jml_mhs','id_makul_identity','id_dosen_identity', 'id_akademik_identity'
    ];

    protected $hidden = [

    ];

    public function users(){
        return $this->hasMany(User::class, 'id', 'id_dosen_identity');
    }

    public function makul(){
        return $this->hasMany(Makul::class, 'id_mata_kuliah', 'id_makul_group');
    }

    public function kelas(){
        return $this->hasMany(Kelas::class, 'id_kelas', 'id_kelas_identity');
    }

    public function akademik(){
        return $this->hasMany(ThnAkademik::class, 'id_akademik', 'id_akademik_identity');
    }

    public function prodi(){
        return $this->hasMany(Prodi::class, 'id_prodi', 'id_prodi_identity');
    }
}
