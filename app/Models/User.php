<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = ['id', 'rtrw_id', 'dasawisma_id', 'username', 'password', 's_aktif', 'nama', 'nik', 'foto'];

    public function rtrw()
    {
        return $this->belongsTo(RTRW::class, 'rtrw_id');
    }

    public function dasawisma()
    {
        return $this->belongsTo(Dasawisma::class, 'dasawisma_id')->withDefault([
            'nama' => '-'
        ]);
    }

    public function modelHasRole()
    {
        return $this->belongsTo(ModelHasRole::class, 'id', 'model_id');
    }
}
