<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    protected $table = 'rumah';
    protected $fillable = ['id', 'dasawisma_id', 'rtrw_id', 'kepala_rumah', 'alamat_detail', 'jamban', 'sumber_air', 'tempat_smph', 'saluran_pmbngn', 'stiker_p4k', 'kriteria_rmh', 'kriteria_rmh', 'layak_huni', 'created_by', 'updated_by'];

    public function dasawisma()
    {
        return $this->belongsTo(Dasawisma::class, 'dasawisma_id');
    }

    public function rtrw()
    {
        return $this->belongsTo(RTRW::class, 'rtrw_id');
    }

    public function kk()
    {
        return $this->hasMany(KartuKeluarga::class, 'rumah_id');
    }

    public function anggota($jenis = null)
    {
        /**
         * 1. Laki - Laki
         * 2. Perempuan
         * 3. Balita
         * 4. PUS
         * 5. WUS
         * 6. 3 Buat
         * 7. Ibu Hamil
         * 8. Ibu Menyusui
         * 9. Berkebutuhan Khusus
         * 10. Lansia
         */

        $data =  $this->hasMany(Anggota::class, 'rumah_id')
            ->join('anggota_details', 'anggota_details.anggota_id', '=', 'anggota.id');

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

    public function queryTable($layak_huni, $kriteria_rmh, $dasawisma_id)
    {
        $data = Rumah::select('id', 'dasawisma_id', 'rtrw_id', 'kepala_rumah', 'alamat_detail', 'kriteria_rmh')
            ->when($layak_huni != 99, function ($q) use ($layak_huni) {
                return $q->where('layak_huni', $layak_huni);
            })
            ->when($kriteria_rmh != 99, function ($q) use ($kriteria_rmh) {
                return $q->where('kriteria_rmh', $kriteria_rmh);
            })
            ->when($dasawisma_id != 0, function ($q) use ($dasawisma_id) {
                return $q->where('dasawisma_id', $dasawisma_id);
            });

        return $data->orderBy('id', 'DESC')->get();
    }
}
