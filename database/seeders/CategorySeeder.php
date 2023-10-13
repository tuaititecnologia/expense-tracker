<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Alimentación',
            'Transporte',
            'Vivienda',
            'Entretenimiento',
            'Salud',
            'Educación',
            'Ropa',
            'Tecnología',
            'Viajes',
            'Otros'
        ];

        $data = [];

        foreach ($categories as $category) {
            $data[] = [
                'name' => $category,
            ];
        }

        Category::insert($data);
    }
}
