<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerihalPengajuan extends Model
{
    use HasFactory;

    protected $table = 'perihal_pengajuans';
    protected $guarded = [];
}
