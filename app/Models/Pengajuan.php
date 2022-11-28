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

    public function queryTable($status, $rtrw_id)
    {
        $data = Pengajuan::select('pengajuans.id as id', 'no_surat', 'tgl_surat', 'tgl_pengajuan', 'pengajuans.nik as nik', 'alasan', 'status')
            ->join('anggota', 'anggota.nik', 'pengajuans.nik')
            ->where('anggota.rtrw_id', $rtrw_id)
            ->whereNotIn('status', [0])
            ->when($status != 99, function($q) use($status) {
                return $q->where('status', $status);
            });

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
