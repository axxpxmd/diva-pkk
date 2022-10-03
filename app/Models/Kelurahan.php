<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahans';
    protected $guarded = [];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function queryTable($kecamatan_id)
    {
        $kecamatans = Kecamatan::select('id')->where('kabupaten_id', 40)->get()->toArray();

        $data = Kelurahan::select('id', 'kode', 'n_kelurahan', 'kecamatan_id', 'ketua_kelurahan')
            ->whereIn('kecamatan_id', $kecamatans)
            ->when($kecamatan_id, function ($q) use ($kecamatan_id) {
                return $q->where('kecamatan_id', $kecamatan_id);
            });

        return $data->orderBy('kecamatan_id', 'ASC')->get();
    }

    public function rt()
    {
        return $this->hasMany(RTRW::class, 'kelurahan_id', 'id');
    }

    public function rw()
    {
        $data = $this->hasMany(RTRW::class, 'kelurahan_id', 'id')->groupBy('rw');

        return $data;
    }

    public function rumah()
    {
        return $this->hasMany(RTRW::class, 'kelurahan_id', 'id')
            ->join('rumah', 'rumah.rtrw_id', '=', 'rt_rw.id');
    }

    public function kk()
    {
        return $this->hasMany(RTRW::class, 'kelurahan_id', 'id')
            ->join('kk', 'kk.rtrw_id', '=', 'rt_rw.id');
    }

    public function warga()
    {
        return $this->hasMany(RTRW::class, 'kelurahan_id', 'id')
            ->join('anggota', 'anggota.rtrw_id', '=', 'rt_rw.id');
    }
}
