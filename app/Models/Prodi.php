<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class prodi extends Model
{
    use HasFactory;
    use softDeletes;

    protected $primaryKey = 'id';
    public $table = "prodi";

    protected $fillable = [
        'id_prodi','nama_prodi'
    ];

    protected $hidden = [

    ];
}
