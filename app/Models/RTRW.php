<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RTRW extends Model
{
    protected $table = 'rt_rw';
    protected $guarded = [];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id')->select([
            'id', 'n_kecamatan'
        ]);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id')->select([
            'id', 'n_kelurahan'
        ]);
    }

    public function dasawisma()
    {
        return $this->hasMany(Dasawisma::class, 'rtrw_id', 'id');
    }

    public static function queryTable()
    {
        $data = RTRW::select('id', 'n_kecamatan', 'n_kelurahan', 'rt', 'rw', 'keterangan', 'ketua_rt')->get();

        return $data;
    }
}
