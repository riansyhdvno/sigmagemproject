<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListCategory extends Model
{
    protected $table = 'listcategories';
    protected $fillable = ['list_kategori'];

    // Relasi ke model Category
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'listcategory_id'); // pastikan nama foreign key sesuai
    }
}
