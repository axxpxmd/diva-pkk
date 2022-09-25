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

    protected $fillable = ['id', 'rtrw_id', 'dasawisma_id', 'username', 'password', 'no_telp', 's_aktif', 'alamat', 'nama', 'nik', 'foto'];

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

    public static function queryTable($rtrw_id, $kecamatan_id, $kelurahan_id)
    {
        $data =  User::select('users.id as id', 'dasawisma_id', 'rtrw_id', 'username', 'no_telp', 'nik', 'alamat', 'nama')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('rt_rw', 'rt_rw.id', '=', 'users.rtrw_id')
            ->whereNotIn('model_has_roles.role_id', [1])
            ->when($kecamatan_id, function ($q) use ($kecamatan_id) {
                return $q->where('kecamatan_id', $kecamatan_id);
            })
            ->when($kelurahan_id, function ($q) use ($kelurahan_id) {
                return $q->where('kelurahan_id', $kelurahan_id);
            })
            ->when($rtrw_id, function ($q) use ($rtrw_id) {
                return $q->where('rt_rw.id', $rtrw_id);
            });

        return $data->OrderBy('users.id', 'DESC')->get();
    }
}
