<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
        'deskripsi',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
