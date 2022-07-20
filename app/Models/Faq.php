<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faq';

    protected $fillable = [
        'question',
        'answer',
        'sort_order'
    ];

    public $timestamps = false;

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('question', 'like', '%'.$query.'%');
    }
}
