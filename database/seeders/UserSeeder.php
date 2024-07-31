<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'administrator123',
            'email' => 'administrator123@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
        ]) ->assignRole('admin');

        User::create([
            'name' => 'asatidz123',
            'email' => 'asatidz123@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
        ]) ->assignRole('petugas');

        User::create([
            'name' => 'mahasantri123',
            'email' => 'mahasantri123@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
        ]) ->assignRole('peminjam');

        User::create([
            'name' => 'peminjam123',
            'email' => 'peminjam123@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
        ]) ->assignRole('peminjam');
    }
}
