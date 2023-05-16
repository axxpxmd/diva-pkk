<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    protected $table = 'kk';
    protected $fillable = ['id', 'rumah_id', 'no_kk', 'nm_kpl_klrga', 'thn_input', 'domisili', 'created_by', 'update_by', 'rtrw_id'];

    public function rumah()
    {
        return $this->belongsTo(Rumah::class, 'rumah_id');
    }

    public function totalKK($kecamatan_id, $kelurahan_id, $rtrw_id)
    {
        $kecamatan_id = $kecamatan_id == 'null' ? null : $kecamatan_id;
        $kelurahan_id = $kelurahan_id == 'null' ? null : $kelurahan_id;
        $rtrw_id = $rtrw_id == 'null' ? null : $rtrw_id;

        return KartuKeluarga::join('rt_rw', 'rt_rw.id', '=', 'kk.rtrw_id')
            ->when($kecamatan_id != null, function ($q) use ($kecamatan_id) {
                return $q->where('kecamatan_id', $kecamatan_id);
            })
            ->when($kelurahan_id != null, function ($q) use ($kelurahan_id) {
                return $q->where('kelurahan_id', $kelurahan_id);
            })
            ->when($rtrw_id != null, function ($q) use ($rtrw_id) {
                return $q->where('rtrw_id', $rtrw_id);
            })
            ->count();
    }

    public function anggota($jenis = null)
    {
        /**
         * 1. Hidup
         * 2. Meninggal
         */

        $data = $this->hasMany(Anggota::class, 'no_kk', 'no_kk');

        switch ($jenis) {
            case '1':
                $data->where('status_hidup', 1);
                break;
            case '2':
                $data->where('status_hidup', 0);
                break;
            default:
                # code...
                break;
        }

        return $data;
    }
}
