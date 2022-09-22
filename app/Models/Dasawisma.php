<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Dasawisma extends Model
{
    protected $table = 'dasawismas';
    protected $guarded = [];

    public function ketua()
    {
        return $this->belongsTo(User::class, 'ketua_id')->withDefault([
            'nama' => '-'
        ]);
    }

    public function rtrw()
    {
        return $this->belongsTo(RTRW::class, 'rtrw_id');
    }

    public static function queryTable($rw, $kecamatan_id, $kelurahan_id)
    {
        $data = Dasawisma::select('dasawismas.id as id', 'rtrw_id', 'nama', 'ketua_id')
            ->join('rt_rw', 'rt_rw.id', '=', 'dasawismas.rtrw_id')
            ->when($kecamatan_id, function ($q) use ($kecamatan_id) {
                return $q->where('kecamatan_id', $kecamatan_id);
            })
            ->when($kelurahan_id, function ($q) use ($kelurahan_id) {
                return $q->where('kelurahan_id', $kelurahan_id);
            })
            ->when($rw, function ($q) use ($rw) {
                return $q->where('rw', $rw);
            });

        return $data->OrderBy('dasawismas.id', 'DESC')->get();
    }
}
