<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPengajuan extends Model
{
    use HasFactory;

    protected $table = 'user_pengajuans';
    protected $guarded = [];
}
