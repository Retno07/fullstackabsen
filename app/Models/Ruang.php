<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruang extends Model
{
    use HasFactory;
    use softDeletes;

    protected $primaryKey = 'id';
    public $table = "ruang";

    protected $fillable = [
        'id_ruang','nama_ruang'
    ];

    protected $hidden = [

    ];
}
