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

    public function anggota($jenis = null, $kecamatan_filter, $kelurahan_filter, $rtrw_filter)
    {
        /**
         * 1. Laki - Laki
         * 2. Perempuan
         * 3. Balita
         * 4. PUS
         * 5. WUS
         * 6. 3 Buta
         * 7. Ibu Hamil
         * 8. Ibu Menyusui
         * 9. Berkebutuhan Khusus
         * 10. Lansia
         * 11. Stunting
         * 12. Domisili Tangsel
         * 13. Domisili Luar Tangsel
         */

        $data =  Anggota::join('rt_rw', 'rt_rw.id', '=', 'anggota.rtrw_id')
            ->join('anggota_details', 'anggota_details.anggota_id', '=', 'anggota.id')
            ->where('status_hidup', 1)
            ->when($kecamatan_filter != 'null', function ($q) use ($kecamatan_filter) {
                return $q->where('kecamatan_id', $kecamatan_filter);
            })
            ->when($kelurahan_filter != 'null', function ($q) use ($kelurahan_filter) {
                return $q->where('kelurahan_id', $kelurahan_filter);
            })
            ->when($rtrw_filter != 'null', function ($q) use ($rtrw_filter) {
                return $q->where('rtrw_id', $rtrw_filter);
            });

        switch ($jenis) {
            case '1':
                $data->where('kelamin', 'Laki - laki');
                break;
            case '2':
                $data->where('kelamin', 'Perempuan');
                break;
            case '3':
                $data->where('status_anak', 'Balita');
                break;
            case '4':
                $data->where('anggota_details.pus', 1);
                break;
            case '5':
                $data->where('anggota_details.wus', 1);
                break;
            case '6':
                $data->where('buta', 1);
                break;
            case '7':
                $data->where('status_ibu', 'Ibu Hamil');
                break;
            case '8':
                $data->where('status_ibu', 'Menyusui');
                break;
            case '9':
                $data->where('kbthn_khusus', 'Ya');
                break;
            case '10':
                $data->where('status_dlm_klrga', 'LIKE', '%Lansia%');
                break;
            case '11':
                $data->where('stunting', 1);
                break;
            case '12':
                $data->where('anggota_details.domisili', 1);
                break;
            case '13':
                $data->where('anggota_details.domisili', 0);
                break;
            default:
                # code...
                break;
        }

        return $data->count();
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
