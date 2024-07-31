<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buku::create([
            'judul' => 'bintang kecil',
            'slug' => Str::slug('bintang'),
            'sampul' => 'sampul buku 1',
            'penulis' => 'penulis buku 2',
            'penerbit_id' => 1,
            'kategori_id' => 1,
            'rak_id' => 1,
            'stok' => 10
        ]);

        Buku::create([
            'judul' => 'matahari',
            'slug' => Str::slug('matahari'),
            'sampul' => 'sampul buku 1',
            'penulis' => 'penulis buku 1',
            'penerbit_id' => 1,
            'kategori_id' => 1,
            'rak_id' => 1,
            'stok' => 10
        ]);
    }
}
