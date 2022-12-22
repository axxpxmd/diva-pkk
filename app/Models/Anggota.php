<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $guarded = [];

    public function anggotaDetail()
    {
        return $this->belongsTo(AnggotaDetail::class, 'id', 'anggota_id');
    }

    public function rumah()
    {
        return $this->belongsTo(Rumah::class, 'rumah_id');
    }

    public function rtrw()
    {
        return $this->belongsTo(RTRW::class, 'rtrw_id');
    }

    public function kk()
    {
        return $this->belongsTo(KartuKeluarga::class, 'no_kk', 'no_kk');
    }

    public function queryTable($rtrw_id, $kecamatan_id, $kelurahan_id, $kelamin, $status_hidup, $dasawisma_id, $rumah_id, $rw, $rt)
    {
        $data = Anggota::select('anggota.id as id', 'nik', 'nama', 'status_hidup', 'rumah_id', 'anggota.rtrw_id as rtrw_id', 'kelamin', 'status_kawin', 'agama', 'no_registrasi', 'status_lengkap')
            ->join('rt_rw', 'rt_rw.id', '=', 'anggota.rtrw_id')
            ->join('rumah', 'rumah.id', '=', 'anggota.rumah_id')
            ->when($rumah_id, function ($q) use ($rumah_id) {
                return $q->where('rumah_id', $rumah_id);
            })
            ->when($kecamatan_id, function ($q) use ($kecamatan_id) {
                return $q->where('kecamatan_id', $kecamatan_id);
            })
            ->when($kelurahan_id, function ($q) use ($kelurahan_id) {
                return $q->where('kelurahan_id', $kelurahan_id);
            })
            ->when($rw, function ($q) use ($rw) {
                return $q->where('rw', $rw);
            })
            ->when($rt, function ($q) use ($rt) {
                return $q->where('rt', $rt);
            })
            ->when($rtrw_id, function ($q) use ($rtrw_id) {
                return $q->where('anggota.rtrw_id', $rtrw_id);
            })
            ->when($dasawisma_id != 0, function ($q) use ($dasawisma_id) {
                return $q->where('rumah.dasawisma_id', $dasawisma_id);
            })
            ->when($kelamin != 99, function ($q) use ($kelamin) {
                return $q->where('kelamin', $kelamin);
            })
            ->when($status_hidup != 99, function ($q) use ($status_hidup) {
                return $q->where('status_hidup', $status_hidup);
            });

        return $data->orderBy('anggota.id', 'DESC')->get();
    }

    public function belumLengkapTotal($kecamatan_id, $kelurahan_id, $rw, $rt, $rtrw_id)
    {
        $data = Anggota::select('anggota.id as id', 'nik', 'nama', 'status_hidup', 'rumah_id', 'anggota.rtrw_id as rtrw_id', 'kelamin', 'status_kawin', 'agama', 'no_registrasi', 'status_lengkap')
            ->join('rt_rw', 'rt_rw.id', '=', 'anggota.rtrw_id')
            ->join('rumah', 'rumah.id', '=', 'anggota.rumah_id')
            ->when($kecamatan_id, function ($q) use ($kecamatan_id) {
                return $q->where('kecamatan_id', $kecamatan_id);
            })
            ->when($kelurahan_id, function ($q) use ($kelurahan_id) {
                return $q->where('kelurahan_id', $kelurahan_id);
            })
            ->when($rw, function ($q) use ($rw) {
                return $q->where('rw', $rw);
            })
            ->when($rt, function ($q) use ($rt) {
                return $q->where('rt', $rt);
            })
            ->when($rtrw_id, function ($q) use ($rtrw_id) {
                return $q->where('anggota.rtrw_id', $rtrw_id);
            })
            ->where('status_lengkap', 0);

        return $data->orderBy('anggota.id', 'DESC')->get();
    }
}
