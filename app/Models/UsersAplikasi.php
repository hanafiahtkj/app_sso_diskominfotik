<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAplikasi extends Model
{
    use HasFactory;

    protected $table = 'users_aplikasi';

    protected $fillable = [
        'id_user',
        'id_aplikasi'
    ];
}
