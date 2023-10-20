<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogPerkuliahan extends Model
{
    use HasFactory;
    use softDeletes;

    protected $primaryKey = 'id_log';
    public $table = "log";

    protected $fillable = [
        'id_identity_log','hari_log','waktu_mulai_log','waktu_selesai_log',
        'id_ruang_log','materi_log','metode_pbm_log',
        'jumlah_mhs_hadir_log',
        'qr_code_log',
        'log_is_verif'
    ];

    protected $hidden = [

    ];

    public function ruang(){
        return $this->belongsTo(Ruang::class, 'id_ruang_log', 'id');
    }

    public function identity(){
        return $this->belongsTo(LogBook::class, 'id_identity_log', 'id_identity');
    }
    
}
