<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingRTRW extends Model
{
    protected $table = 'rt_mappings';
    protected $guarded = [];

    public function rtrw()
    {
        return $this->belongsTo(RTRW::class, 'rtrw_id');
    }
}
