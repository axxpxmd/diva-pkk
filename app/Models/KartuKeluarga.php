<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    protected $table = 'kk';
    protected $fillable = ['id', 'rumah_id', 'no_kk', 'nm_kpl_klrga', 'thn_input', 'domisili', 'created_by', 'update_by'];

    public function rumah()
    {
        return $this->belongsTo(Rumah::class, 'rumah_id');
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
