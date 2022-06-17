<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Dasawisma extends Model
{
    protected $table = 'dasawismas';
    protected $guarded = [];

    public function ketua()
    {
        return $this->belongsTo(User::class, 'ketua_id')->withDefault([
            'nama' => '-'
        ]);
    }

    public function rtrw()
    {
        return $this->belongsTo(RTRW::class, 'rtrw_id');
    }
}
