<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DasawismaUser extends Model
{
    protected $table = 'dasawisma_users';
    protected $fillable = ['id', 'user_id', 'dasawisma_id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    public function dasawisma()
    {
        return $this->belongsTo(Dasawisma::class, 'dasawisma_id');
    }

}
