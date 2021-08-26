<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGedung extends Model
{
    use HasFactory;

    protected $table = 'master_gedung';

    protected $fillable = [
                            'id_kantor_induk',
                            'id_unit_level2',
                            'id_unit_level3',
                            'nama_gedung',
                            'company_code',
                            'busines_area'
                        ];

    public function KantorInduk(){
        return $this->belongsTo(KantorInduk::class,'id_kantor_induk','id');
    }

    public function UnitLevel2(){
        return $this->belongsTo(UnitLevel2::class,'id_unit_level2','id');
    }

    public function UnitLevel3(){
        return $this->belongsTo(UnitLevel3::class,'id_unit_level3','id');
    }
}
