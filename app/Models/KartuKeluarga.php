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

    public function totalKK($kecamatan_filter, $kelurahan_filter, $rtrw_filter)
    {
        $kecamatan_filter = $kecamatan_filter == 'null' ? null : $kecamatan_filter;
        $kelurahan_filter = $kelurahan_filter == 'null' ? null : $kelurahan_filter;
        $rtrw_filter = $rtrw_filter == 'null' ? null : $rtrw_filter;

        return KartuKeluarga::join('rt_rw', 'rt_rw.id', '=', 'kk.rtrw_id')
            ->when($kecamatan_filter != null, function ($q) use ($kecamatan_filter) {
                return $q->where('kecamatan_id', $kecamatan_filter);
            })
            ->when($kelurahan_filter != null, function ($q) use ($kelurahan_filter) {
                return $q->where('kelurahan_id', $kelurahan_filter);
            })
            ->when($rtrw_filter != null, function ($q) use ($rtrw_filter) {
                return $q->where('rtrw_id', $rtrw_filter);
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
