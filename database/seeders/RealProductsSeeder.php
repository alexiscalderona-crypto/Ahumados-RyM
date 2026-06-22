<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class RealProductsSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar pedidos, productos y categorías anteriores
        \App\Models\OrderItem::query()->delete();
        \App\Models\Order::query()->delete();
        Product::query()->delete();
        Category::query()->delete();

        // Crear categorías reales del negocio
        $cecinas   = Category::create(['name' => 'Cecinas',       'slug' => 'cecinas']);
        $carnes    = Category::create(['name' => 'Carnes',        'slug' => 'carnes']);
        $derivados = Category::create(['name' => 'Derivados',     'slug' => 'derivados']);
        $otros     = Category::create(['name' => 'Otros',         'slug' => 'otros']);

        // ===== 12 PRODUCTOS REALES DE AHUMADOS R Y M =====
        // Precios por kilo (S/)
        // Descripción e imagen quedan pendientes para que el admin las complete

        // 1. Cecina Pierna - S/ 38/kl (al mayor S/ 36)
        Product::create([
            'category_id' => $cecinas->id,
            'title'       => 'Cecina Pierna',
            'description' => 'Pendiente - Agregar descripción desde el panel admin',
            'price'       => 38.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 2. Cecina Lomo - S/ 40/kl (al mayor S/ 38)
        Product::create([
            'category_id' => $cecinas->id,
            'title'       => 'Cecina Lomo',
            'description' => 'Pendiente - Agregar descripción desde el panel admin',
            'price'       => 40.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 3. Costilla - S/ 38/kl (al mayor S/ 36)
        Product::create([
            'category_id' => $carnes->id,
            'title'       => 'Costilla',
            'description' => 'Pendiente - Agregar descripción desde el panel admin',
            'price'       => 38.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 4. Chorizo - S/ 38/kl (al mayor S/ 36)
        Product::create([
            'category_id' => $derivados->id,
            'title'       => 'Chorizo',
            'description' => 'Pendiente - Agregar descripción desde el panel admin',
            'price'       => 38.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 5. Patitas - S/ 18/kl (al mayor S/ 15)
        Product::create([
            'category_id' => $carnes->id,
            'title'       => 'Patitas',
            'description' => 'Pendiente - Agregar descripción desde el panel admin',
            'price'       => 18.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 6. Huesitos Cadera - S/ 15/kl (al mayor S/ 13)
        Product::create([
            'category_id' => $carnes->id,
            'title'       => 'Huesitos Cadera',
            'description' => 'Pendiente - Agregar descripción desde el panel admin',
            'price'       => 15.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 7. Huesitos Piernas - S/ 10/kl (al mayor S/ 8)
        Product::create([
            'category_id' => $carnes->id,
            'title'       => 'Huesitos Piernas',
            'description' => 'Pendiente - Agregar descripción desde el panel admin',
            'price'       => 10.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 8. Cuero - S/ 14/kl (al mayor S/ 10)
        Product::create([
            'category_id' => $otros->id,
            'title'       => 'Cuero',
            'description' => 'Pendiente - Agregar descripción desde el panel admin',
            'price'       => 14.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 9. Menudencias - S/ 16/kl (pura tripa S/ 40)
        Product::create([
            'category_id' => $otros->id,
            'title'       => 'Menudencias',
            'description' => 'Pendiente - Agregar descripción desde el panel admin',
            'price'       => 16.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 10. Oreja - S/ 18/kl (al mayor S/ 15)
        Product::create([
            'category_id' => $otros->id,
            'title'       => 'Oreja',
            'description' => 'Pendiente - Agregar descripción desde el panel admin',
            'price'       => 18.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 11. Chicharrón - S/ 30/kl (no sale al mayor)
        Product::create([
            'category_id' => $derivados->id,
            'title'       => 'Chicharrón',
            'description' => 'Pendiente - Agregar descripción desde el panel admin',
            'price'       => 30.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 12. Manteca - S/ 20/kl (no sale al mayor)
        Product::create([
            'category_id' => $otros->id,
            'title'       => 'Manteca',
            'description' => 'Pendiente - Agregar descripción desde el panel admin',
            'price'       => 20.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);
    }
}
