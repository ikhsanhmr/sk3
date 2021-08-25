<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGedung extends Model
{
    use HasFactory;

    protected $table = 'master_gedung';
    protected $fillable = ['nama_gedung','company_code','busines_area'];
}
