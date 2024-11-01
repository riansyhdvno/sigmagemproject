<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories'; // Pastikan nama tabel benar
    protected $fillable = ['listcategory_id', 'nama_kategori', 'gambar']; // Kolom yang bisa diisi

    public function listCategory()
    {
        return $this->belongsTo(ListCategory::class, 'listcategory_id');
    }
}
