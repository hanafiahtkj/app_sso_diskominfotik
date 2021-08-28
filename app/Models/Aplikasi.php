<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    use HasFactory;

    protected $table = 'aplikasi';

    protected $fillable = [
        'nama',
        'id_kategori',
        'keterangan',
        'base_url',
        'base_url_sso',
        'path',
        'file_name',
    ];

    // protected $appends = [
    //     'profile_photo_url',
    // ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nama', 'like', '%'.$query.'%')
                ->orWhere('keterangan', 'like', '%'.$query.'%');
    }

}
