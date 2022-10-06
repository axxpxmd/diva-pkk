<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MappingRW extends Model
{
    protected $table = 'rw_mappings';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'nik', 'nik');
    }
}
