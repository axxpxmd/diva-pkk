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

        return $data->orderBy('kode', 'ASC')->get();
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

    public function warga($jenis = null)
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
         */

        $data = $this->hasMany(RTRW::class, 'kelurahan_id', 'id')
            ->join('anggota', 'anggota.rtrw_id', '=', 'rt_rw.id')
            ->join('anggota_details', 'anggota_details.anggota_id', '=', 'anggota.id')
            ->where('status_hidup', 1);

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
            default:
                # code...
                break;
        }

        return $data;
    }
}
