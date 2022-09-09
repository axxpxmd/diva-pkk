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

    public function queryTable($dasawisma_id)
    {
        $datas = Rumah::select('id', 'dasawisma_id', 'rtrw_id', 'kepala_rumah', 'alamat_detail', 'kriteria_rmh')
            ->when($dasawisma_id != 0, function ($q) use ($dasawisma_id) {
                return $q->where('dasawisma_id', $dasawisma_id);
            })
            ->orderBy('id', 'DESC')
            ->get();

        return $datas;
    }
}
