<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    protected $table = 'kk';
    protected $fillable = ['id', 'rumah_id', 'no_kk', 'nm_kpl_klrga', 'thn_input', 'domisili', 'created_by', 'update_by'];
}
