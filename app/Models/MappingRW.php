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

    public static function checkStatusAktif($nik)
    {
        $data = MappingRW::where('nik', $nik)->where('status', 1)->first();

        return $data;
    }
}
