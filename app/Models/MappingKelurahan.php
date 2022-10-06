<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MappingKelurahan extends Model
{
    protected $table = 'kelurahan_mappings';
    protected $guarded = [];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nik', 'nik');
    }
}
