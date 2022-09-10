<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function kk()
    {
        return $this->belongsTo(KartuKeluarga::class, 'no_kk', 'no_kk');
    }

    public function queryTable()
    {
        $data = Anggota::orderBy('id', 'DESC')->get();

        return $data;
    }
}
