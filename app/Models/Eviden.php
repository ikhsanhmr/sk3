<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eviden extends Model
{
    use HasFactory;
    protected $table = 'eviden';
    protected $fillable = ['id_jadwal','image','vide','pdf'];

    public function Jadwal(){
        return $this->belongsTo(Jadwal::class,'id_jadwal','id');
    }
}
