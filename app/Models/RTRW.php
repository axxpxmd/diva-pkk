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
            'id', 'n_kelurahan', 'kode'
        ]);
    }

    public function ketuaRT()
    {
        return $this->hasMany(MappingRT::class, 'rtrw_id', 'id');
    }

    public function dasawisma()
    {
        return $this->hasMany(Dasawisma::class, 'rtrw_id', 'id');
    }

    public function rumah()
    {
        return $this->hasMany(Rumah::class, 'rtrw_id');
    }

    public function kk()
    {
        return $this->hasMany(KartuKeluarga::class, 'rtrw_id');
    }

    public function warga()
    {
        return $this->hasMany(Anggota::class, 'rtrw_id');
    }

    public static function queryTable($rw, $kecamatan_id, $kelurahan_id)
    {
        $data = RTRW::select('id', 'kecamatan_id', 'kelurahan_id', 'n_kecamatan', 'n_kelurahan', 'rt', 'rw', 'keterangan', 'ketua_rt', 'ketua_rw')
            ->when($kecamatan_id, function ($q) use ($kecamatan_id) {
                return $q->where('kecamatan_id', $kecamatan_id);
            })
            ->when($kelurahan_id, function ($q) use ($kelurahan_id) {
                return $q->where('kelurahan_id', $kelurahan_id);
            })
            ->when($rw, function($q) use($rw) {
                return $q->where('rw', $rw);
            });

        return $data->orderBy('id', 'ASC')->get();
    }
}
