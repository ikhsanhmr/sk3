<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KantorInduk extends Model
{
    use HasFactory;
    protected $table = 'kantor_induk';

    public function unitLevel2()
    {
        return $this->hasMany(UnitLevel2::class, 'kantor_induk_id');
    }
}
