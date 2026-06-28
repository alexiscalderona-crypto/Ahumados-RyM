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
            'description' => 'La cecina es un producto tradicional de la gastronomía amazónica peruana, elaborado a partir de carne de cerdo seleccionada. El proceso de preparación consiste en el salado y sazonado de la carne, seguido de un proceso de ahumado natural que le otorga su característico aroma, sabor y color. Posteriormente, la carne es cocida o frita para su consumo. Es uno de los acompañamientos más representativos de la cocina selvática y suele servirse con tacacho, plátano asado o yuca.',
            'price'       => 38.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 2. Cecina Lomo - S/ 40/kl (al mayor S/ 38)
        Product::create([
            'category_id' => $cecinas->id,
            'title'       => 'Cecina Lomo',
            'description' => 'Elaborada con cortes de lomo fino de cerdo cuidadosamente seleccionados. Su preparación incluye el adobado y ahumado artesanal, obteniendo una carne tierna, jugosa y de exquisito sabor.',
            'price'       => 40.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 3. Costilla - S/ 38/kl (al mayor S/ 36)
        Product::create([
            'category_id' => $carnes->id,
            'title'       => 'Costilla',
            'description' => 'La costilla de cerdo es un corte seleccionado que se prepara mediante un cuidadoso proceso de adobado con especias y condimentos naturales. Posteriormente, se cocina a la parrilla, frita o al horno, obteniendo una carne tierna, jugosa y de excelente sabor. Es un producto muy apreciado en la gastronomía regional por su calidad y valor nutritivo.',
            'price'       => 38.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 4. Chorizo - S/ 38/kl (al mayor S/ 36)
        Product::create([
            'category_id' => $derivados->id,
            'title'       => 'Chorizo',
            'description' => 'El chorizo amazónico es un embutido artesanal elaborado con carne de cerdo fresca, grasa seleccionada y una mezcla especial de condimentos naturales. La preparación incluye el picado de la carne, el sazonado y el embutido en tripa natural. Posteriormente, puede ser ahumado o cocinado según la tradición local. Destaca por su sabor intenso y su textura jugosa, siendo un complemento ideal para el tacacho y otros platos típicos de la Amazonía.',
            'price'       => 38.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 5. Patitas - S/ 18/kl (al mayor S/ 15)
        Product::create([
            'category_id' => $carnes->id,
            'title'       => 'Patitas',
            'description' => 'Las patitas de cerdo son un producto tradicional elaborado a partir de patas de cerdo previamente seleccionadas y sometidas a un proceso de limpieza, cocción y sazonado. Su preparación resalta la textura gelatinosa característica del colágeno natural, convirtiéndolas en una opción muy valorada dentro de la cocina amazónica y peruana.',
            'price'       => 18.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 6. Huesitos Cadera - S/ 15/kl (al mayor S/ 13)
        Product::create([
            'category_id' => $carnes->id,
            'title'       => 'Huesitos Cadera',
            'description' => 'Huesos de cerdo seleccionados y procesados higiénicamente, ideales para la preparación de caldos, sopas y guisos, aportando sabor y consistencia a las comidas.',
            'price'       => 15.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 7. Huesitos Piernas - S/ 10/kl (al mayor S/ 8)
        Product::create([
            'category_id' => $carnes->id,
            'title'       => 'Huesitos Piernas',
            'description' => 'Huesos de cerdo seleccionados y procesados higiénicamente, ideales para la preparación de caldos, sopas y guisos, aportando sabor y consistencia a las comidas.',
            'price'       => 10.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 8. Cuero - S/ 14/kl (al mayor S/ 10)
        Product::create([
            'category_id' => $otros->id,
            'title'       => 'Cuero',
            'description' => 'El cuero de cerdo es un producto obtenido de la piel del cerdo, cuidadosamente procesada mediante limpieza, cocción y sazonado. Dependiendo de la preparación, puede consumirse cocido, frito o como complemento de diversos platos típicos. Se caracteriza por su textura particular y su aporte de sabor a la gastronomía tradicional amazónica.',
            'price'       => 14.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 9. Menudencias - S/ 16/kl (pura tripa S/ 40)
        Product::create([
            'category_id' => $otros->id,
            'title'       => 'Menudencias',
            'description' => 'Conjunto de partes seleccionadas del cerdo, procesadas bajo estrictas condiciones de higiene. Muy utilizadas en la gastronomía regional por su sabor y valor nutritivo.',
            'price'       => 16.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 10. Oreja - S/ 18/kl (al mayor S/ 15)
        Product::create([
            'category_id' => $otros->id,
            'title'       => 'Oreja',
            'description' => 'Producto cuidadosamente seleccionado y preparado mediante procesos de limpieza y cocción. Destaca por su textura firme y su apreciado sabor tradicional.',
            'price'       => 18.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 11. Chicharrón - S/ 30/kl (no sale al mayor)
        Product::create([
            'category_id' => $derivados->id,
            'title'       => 'Chicharrón',
            'description' => 'Preparado a partir de carne y grasa de cerdo de alta calidad, cocinadas hasta obtener una textura crujiente y un sabor inconfundible. Ideal para desayunos y platos típicos de la región; Infalible en la preparación del tacacho regional.',
            'price'       => 30.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);

        // 12. Manteca - S/ 20/kl (no sale al mayor)
        Product::create([
            'category_id' => $otros->id,
            'title'       => 'Manteca',
            'description' => 'Grasa de cerdo procesada de forma tradicional, utilizada como ingrediente culinario para aportar sabor y textura a diversas preparaciones gastronómicas, cabe recalcar que también es uno de los ingredientes infaltables en la preparación del tacacho regional.',
            'price'       => 20.00,
            'stock'       => 100,
            'image_path'  => null,
        ]);
    }
}
