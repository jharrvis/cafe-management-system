<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        // Create categories
        $milkshakeCategory = Category::create([
            'name' => 'Milkshake',
            'description' => 'Berbagai varian milkshake segar dan nikmat',
            'is_active' => true,
        ]);

        $snackCategory = Category::create([
            'name' => 'Snack',
            'description' => 'Berbagai jenis snack gurih dan lezat',
            'is_active' => true,
        ]);

        $foodCategory = Category::create([
            'name' => 'Makanan',
            'description' => 'Berbagai jenis makanan utama',
            'is_active' => true,
        ]);

        // Create milkshake products
        $milkshakes = [
            [
                'name' => 'Milkshake Coklat',
                'description' => 'Milkshake coklat lembut dan creamy',
                'price' => 15000,
                'stock' => 20,
                'is_available' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Milkshake Strawberry',
                'description' => 'Milkshake stroberi segar dengan irisan buah',
                'price' => 15000,
                'stock' => 20,
                'is_available' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Milkshake Vanilla',
                'description' => 'Milkshake vanilla klasik dengan taburan kacang',
                'price' => 15000,
                'stock' => 20,
                'is_available' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Milkshake Oreo',
                'description' => 'Milkshake dengan butiran oreo yang renyah',
                'price' => 17000,
                'stock' => 15,
                'is_available' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Milkshake Red Velvet',
                'description' => 'Milkshake red velvet dengan cream cheese',
                'price' => 18000,
                'stock' => 15,
                'is_available' => true,
                'is_active' => true,
            ]
        ];

        foreach ($milkshakes as $milkshake) {
            Product::create(array_merge($milkshake, ['category_id' => $milkshakeCategory->id]));
        }

        // Create snack products
        $snacks = [
            [
                'name' => 'Kentang Goreng',
                'description' => 'Kentang goreng renyah dengan bumbu pilihan',
                'price' => 8000,
                'stock' => 30,
                'is_available' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Chicken Nugget',
                'description' => 'Nugget ayam gurih dengan saus',
                'price' => 10000,
                'stock' => 25,
                'is_available' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Onion Ring',
                'description' => 'Cincin bawang goreng renyah',
                'price' => 7000,
                'stock' => 20,
                'is_available' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Roti Bakar',
                'description' => 'Roti bakar dengan berbagai toping',
                'price' => 10000,
                'stock' => 20,
                'is_available' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Siomay',
                'description' => 'Siomay ayam dengan saus kacang',
                'price' => 12000,
                'stock' => 15,
                'is_available' => true,
                'is_active' => true,
            ]
        ];

        foreach ($snacks as $snack) {
            Product::create(array_merge($snack, ['category_id' => $snackCategory->id]));
        }

        // Create food products
        $foods = [
            [
                'name' => 'Nasi Goreng',
                'description' => 'Nasi goreng spesial dengan telur',
                'price' => 18000,
                'stock' => 15,
                'is_available' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Mie Goreng',
                'description' => 'Mie goreng dengan sayuran segar',
                'price' => 15000,
                'stock' => 15,
                'is_available' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Bakso',
                'description' => 'Bakso ayam dengan kuah gurih',
                'price' => 15000,
                'stock' => 10,
                'is_available' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Sate Ayam',
                'description' => 'Sate ayam dengan bumbu kacang',
                'price' => 20000,
                'stock' => 10,
                'is_available' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Ayam Geprek',
                'description' => 'Ayam geprek pedas dengan lalapan',
                'price' => 18000,
                'stock' => 10,
                'is_available' => true,
                'is_active' => true,
            ]
        ];

        foreach ($foods as $food) {
            Product::create(array_merge($food, ['category_id' => $foodCategory->id]));
        }
    }
}