<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitLevel3 extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'unit_level3';

    public function unitLevel2()
    {
        return $this->belongsTo(UnitLevel2::class, 'unit_level2_id', 'id');
    }
}
