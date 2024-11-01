<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Seeder untuk kategori Gaming
        Category::create([
            'listcategory_id' => 1, // ID dari listcategory "Gaming"
            'nama_kategori' => 'Mouse',
            'gambar' => 'category_images/mouse.png',
        ]);

        Category::create([
            'listcategory_id' => 1,
            'nama_kategori' => 'Keyboard',
            'gambar' => 'category_images/keyboard.png',
        ]);

        Category::create([
            'listcategory_id' => 1,
            'nama_kategori' => 'Headphone',
            'gambar' => 'category_images/headphone.png',
        ]);

        // Seeder untuk kategori Gadget
        Category::create([
            'listcategory_id' => 2, // ID dari listcategory "Gadget"
            'nama_kategori' => 'Handphone',
            'gambar' => 'category_images/handphone.png',
        ]);

        Category::create([
            'listcategory_id' => 2,
            'nama_kategori' => 'Camera',
            'gambar' => 'category_images/camera.png',
        ]);

        // Tambahkan data lain sesuai kebutuhan
    }
}
