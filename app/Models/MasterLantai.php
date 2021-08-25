<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterLantai extends Model
{
    use HasFactory;
    protected $table = 'master_lantai';
    protected $fillable = ['nama_lantai','id_gedung'];
}
