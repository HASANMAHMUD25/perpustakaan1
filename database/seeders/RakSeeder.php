<?php

namespace Database\Seeders;

use App\Models\Rak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i < 10; $i++) {
       Rak::create([
           'rak' => '1',
           'baris' => $i,
           'kategori_id' => '1',
           'slug' => 1 .'-' .$i
       ]);
    }
    }
}
