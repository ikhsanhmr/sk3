<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apar extends Model
{
    use HasFactory;

    protected $table = 'apar';

    protected $fillable = [
                            'id_gedung',
                            'id_lantai',
                            'lokasi_apar',
                            'nomor_urut',
                            'foto_apar',
                            'merk_apar',
                            'type_apar',
                            'kapasitas',
                            'media',
                            'tanggal_expired',
                            'jadwal_refill',
                            'jadwal_triwulanan'
                        ];

    public function MasterGedung(){
        return $this->belongsTo(MasterGedung::class,'id_gedung','id');
    }

    public function MasterLantai(){
        return $this->belongsTo(MasterLantai::class,'id_lantai','id');
    }
}
