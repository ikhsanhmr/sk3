<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';

    protected $fillable = ['id_kantor_induk','id_unit_level2','id_unit_level3','lokasi','koordinat','deskripsi'];

    public function Eviden(){
        return $this->hasMany(Eviden::class);
    }
}
