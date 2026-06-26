<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin Ecommerce',
            'email' => 'admin@ecommerceit.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Regular user
        User::create([
            'name' => 'Husein',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Payment Methods
        $payments = [
            ['name' => 'Gopay', 'code' => 'gopay'],
            ['name' => 'Dana', 'code' => 'dana'],
            ['name' => 'QRIS', 'code' => 'qris'],
            ['name' => 'Bank Transfer', 'code' => 'bank_transfer'],
        ];

        foreach ($payments as $payment) {
            PaymentMethod::create($payment);
        }

        // Categories with Specific Slugs and Images
        $categoriesData = [
            ['name' => 'Server', 'icon' => 'server'],
            ['name' => 'PC', 'icon' => 'desktop-computer'],
            ['name' => 'Laptop', 'icon' => 'device-laptop'],
            ['name' => 'HP', 'icon' => 'device-mobile'],
            ['name' => 'Networking', 'icon' => 'rss'],
            ['name' => 'Aksesoris', 'icon' => 'keyboard'],
        ];

        $productImages = [
            'Server' => 'https://images.unsplash.com/photo-1558449028-b53a39d100fc?q=80&w=1000&auto=format&fit=crop',
            'PC' => 'https://images.unsplash.com/photo-1593640408182-31c70c8268f5?q=80&w=1000&auto=format&fit=crop',
            'Laptop' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=1000&auto=format&fit=crop',
            'HP' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=1000&auto=format&fit=crop',
            'Networking' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?q=80&w=1000&auto=format&fit=crop',
            'Aksesoris' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?q=80&w=1000&auto=format&fit=crop',
        ];

        foreach ($categoriesData as $catData) {
            $category = Category::create([
                'name' => $catData['name'],
                'slug' => Str::slug($catData['name']),
            ]);

            // Create 3 products for each category
            for ($i = 1; $i <= 3; $i++) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $catData['name'] . ' ' . $this->getBrand($i) . ' Series ' . $i,
                    'slug' => Str::slug($catData['name'] . ' ' . $this->getBrand($i) . ' Series ' . $i),
                    'price' => rand(1000000, 50000000),
                    'description' => 'Ini adalah unit ' . $catData['name'] . ' premium dengan performa tinggi. Cocok untuk kebutuhan profesional dan enterprise.',
                    'stock' => rand(1, 100),
                    'image' => $productImages[$catData['name']],
                ]);
            }
        }
    }

    private function getBrand($i) {
        $brands = ['Pro', 'Ultra', 'Extreme', 'Elite'];
        return $brands[$i % 4];
    }
}
