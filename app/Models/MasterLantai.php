<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterLantai extends Model
{
    use HasFactory;
    protected $table = 'master_lantai';

    protected $fillable = [
                            'id_kantor_induk',
                            'id_unit_level2',
                            'id_unit_level3',
                            'nama_lantai',
                            'id_gedung'
                        ];
}
