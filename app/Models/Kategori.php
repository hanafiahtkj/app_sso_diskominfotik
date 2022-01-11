<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama',
        'keterangan',
        'urut',
        'path',
        'file_name',
    ];

    public function aplikasi()
    {
        return $this->hasMany(Aplikasi::class, 'id_kategori', 'id')->orderBy('order', 'asc');
    }

}
