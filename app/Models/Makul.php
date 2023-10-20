<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Makul extends Model
{
    use HasFactory;
    use softDeletes;

    protected $primaryKey = 'id';
    public $table = "mata_kuliah";

    protected $fillable = [
        'id_mata_kuliah','id_prodi','nama_mata_kuliah','sks_mata_kuliah','semester_mata_kuliah'
    ];

    protected $hidden = [

    ];

    public function prodi(){
        return $this->hasMany(Prodi::class, 'id_prodi', 'id_prodi');
    }
}
