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

    public function kk()
    {
        return $this->belongsTo(KartuKeluarga::class, 'no_kk', 'no_kk');
    }

    public function queryTable($kelamin, $status_hidup, $dasawisma_id)
    {
        $data = Anggota::select('anggota.id as id', 'nik', 'nama', 'status_hidup')
            ->join('rumah', 'rumah.id', '=', 'anggota.rumah_id')
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
}
