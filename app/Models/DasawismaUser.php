<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DasawismaUser extends Model
{
    protected $table = 'dasawisma_users';
    protected $fillable = ['id', 'user_id', 'dasawisma_id', 'created_at', 'updated_at'];

}
