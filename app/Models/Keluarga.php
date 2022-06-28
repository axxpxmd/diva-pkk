<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $table = 'keluargas';
    protected $guarded = [];

    public function jumlahDetail()
    {
        return $this->belongsTo(JumlahDetail::class, 'jml_detail_id');
    }

    public function dasawisma()
    {
        return $this->belongsTo(Dasawisma::class, 'dasawisma_id');
    }
}
