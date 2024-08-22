<?php

namespace Database\Seeders;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = ['none', 'novel', 'sejarah', 'religi', 'biografi', 'komik'];

        foreach ($kategori as $value) {
            Kategori::create([
                'nama' => $value,
                'slug' => Str::slug($value)
            ]);
        }
       
    }
}

