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

    public function queryTable()
    {
        $data = Pengajuan::all();

        return $data;
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
