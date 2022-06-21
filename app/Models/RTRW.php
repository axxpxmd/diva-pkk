<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RTRW extends Model
{
    protected $table = 'rt_rw';
    protected $guarded = [];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }

    public static function queryTable()
    {
        $data = RTRW::select('kecamatan_id', 'kelurahan_id', 'rt', 'rw', 'keterangan')->get();

        return $data;
    }
}
