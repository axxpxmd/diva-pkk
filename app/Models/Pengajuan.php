<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuans';
    protected $guarded = [];

    public function pengajuans()
    {
        return $this->hasMany(PerihalPengajuan::class, 'id', 'pengajuan_id');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'nik', 'nik');
    }

    public function UserPengajuan()
    {
        return $this->belongsTo(UserPengajuan::class, 'nik', 'nik');
    }

    public function queryTable($kecamatan_id, $kelurahan_id, $rtrw_id, $rt, $rw, $status, $isRT)
    {
        $data = Pengajuan::select('pengajuans.id as id', 'no_surat', 'tgl_surat', 'tgl_pengajuan', 'pengajuans.nik as nik', 'alasan', 'status')
            ->join('anggota', 'anggota.nik', 'pengajuans.nik')
            ->join('rt_rw', 'rt_rw.id', '=', 'anggota.rtrw_id')
            ->when($kecamatan_id, function ($q) use ($kecamatan_id) {
                return $q->where('kecamatan_id', $kecamatan_id);
            })
            ->when($kelurahan_id, function ($q) use ($kelurahan_id) {
                return $q->where('kelurahan_id', $kelurahan_id);
            })
            ->when($rtrw_id, function ($q) use ($rtrw_id) {
                return $q->where('rtrw_id', $rtrw_id);
            })
            ->when($rw, function ($q) use ($rw) {
                return $q->where('rw', $rw);
            })
            ->when($rt, function ($q) use ($rt) {
                return $q->where('rt', $rt);
            });

        if ($isRT) {
            $data->whereNotIn('status', [0]);

            if ($status >= 3) {
                $data->whereIn('status', [3, 4, 5, 6]);
            }
            if ($status == 1) {
                $data->where('status', 1);
            }
            if ($status == 2) {
                $data->where('status', 2);
            }
        } else {
            $data->whereNotIn('status', [0, 1, 2, 3]);
            
            if ($status == 4) {
                $data->where('status', 4);
            }
            if ($status == 5) {
                $data->where('status', 5);
            }
            if ($status == 6) {
                $data->where('status', 6);
            }
        }

        return $data->orderBy('pengajuans.created_at', 'DESC')->get();
    }

    public function user()
    {
        return $this->belongsTo(UserPengajuan::class, 'nik', 'nik');
    }

    public function perihal()
    {
        return $this->hasMany(PerihalPengajuan::class, 'pengajuan_id');
    }
}
