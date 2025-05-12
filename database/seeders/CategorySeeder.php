<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Gaji', 'type' => 'pemasukan'],
            ['name' => 'Makanan', 'type' => 'pengeluaran'],
            ['name' => 'Transportasi', 'type' => 'pengeluaran'],
            ['name' => 'Hiburan', 'type' => 'pengeluaran'],
            ['name' => 'Kuota', 'type' => 'pengeluaran'],
            ['name' => 'Admin Rekening', 'type' => 'pengeluaran'],
            ['name' => 'Bonus', 'type' => 'pemasukan'],
            ['name' => 'Sewa Kos', 'type' => 'pengeluaran'],
            ['name' => 'Traveling', 'type' => 'pengeluaran'],
            ['name' => 'Lainnya', 'type' => 'pengeluaran'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
