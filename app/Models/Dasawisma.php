<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dasawisma extends Model
{
    protected $table = 'dasawismas';
    protected $guarded = [];

    public function rtrw()
    {
        return $this->belongsTo(RTRW::class, 'rtrw_id');
    }

    public function dasawismaUser()
    {
        return $this->hasMany(DasawismaUser::class, 'dasawisma_id');
    }

    public static function queryTable($kecamatan_id, $kelurahan_id, $rw, $rt)
    {
        $data = Dasawisma::select('dasawismas.id as id', 'rtrw_id', 'nama')
            ->join('rt_rw', 'rt_rw.id', '=', 'dasawismas.rtrw_id')
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
            });

        return $data->OrderBy('dasawismas.id', 'DESC')->get();
    }

    public function rumah($jenis = null)
    {
        return $this->hasMany(Rumah::class, 'rtrw_id', 'rtrw_id')
            ->join('rt_rw', 'rt_rw.id', '=', 'rumah.rtrw_id')
            ->when($jenis == 1, function ($q) {
                $q->groupBy('kecamatan_id', 'kelurahan_id', 'rw');
            });
    }

    public function kk($jenis = null)
    {
        return $this->hasMany(KartuKeluarga::class, 'rtrw_id', 'rtrw_id')
            ->join('rt_rw', 'rt_rw.id', '=', 'kk.rtrw_id')
            ->when($jenis == 1, function ($q) {
                $q->groupBy('kecamatan_id', 'kelurahan_id', 'rw');
            });
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

        $data = $this->hasMany(Anggota::class, 'rtrw_id', 'rtrw_id')
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
