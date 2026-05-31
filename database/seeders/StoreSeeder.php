<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $cat1 = Category::create(['name' => 'Carnes Selectas', 'slug' => 'carnes-selectas']);
        $cat2 = Category::create(['name' => 'Embutidos', 'slug' => 'embutidos']);
        $cat3 = Category::create(['name' => 'Packs', 'slug' => 'packs']);

        Product::create([
            'category_id' => $cat2->id,
            'title' => 'Tocino Ahumado Roble',
            'description' => 'Ahumado por 12 horas con madera de roble seleccionado.',
            'price' => 703.00,
            'stock' => 50,
            'image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBdTmc4ggz-Cqr0Va5SxMcdkj_epryGPXcf4O8L98So0RxsL-sOLq5fNhXrM8D99tH3X19z6eh2OpZ1YrhfTzet5BqfewMfho1YMcn-rpuatEHyiE30KKL5W6TfCY-1E81Tlmy9Y0RlQ9sO5HcMBbyv6AbuuGkVh_QN8ZnT5mm-fecFDU5oSWWHLfQeBlSgHiTCj99cCklM0At7ULbr9ymebbWBV6YoV0stnPYRBJGfVQuBcye9SOfPWI9YIsotcArP_mO7uzfjATFv'
        ]);

        Product::create([
            'category_id' => $cat2->id,
            'title' => 'Chorizo Tradición R y M',
            'description' => 'Mezcla secreta de especias y 48 horas de ahumado en frío.',
            'price' => 490.20,
            'stock' => 100,
            'image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBuu1AYbtSq0CRH_N6MpT4sIEfsE5Fy1fMoo8MS--2ZX3p76e9c-Yd1on5oC8KRu1_wWCSWAGFH5xgEtvLNGnHSDcMNfbKpvftadw8_0FM099SXGwiVGs4RdMkd9_u5YcTAFKHieMIP86Wd5PgE8uIPa4L32EgkfYWlAzcjv3jC-J0dk03-gUUI7uKUna6jgvKe3uDQo81KhkLJt0XxU3aFM113o8qWn0vDRZDPqmoVm5W4MuG0mgMCnxTwPaTsjYg1m_4O6OcMAr5K'
        ]);

        Product::create([
            'category_id' => $cat1->id,
            'title' => 'Pastrami de Res Angus',
            'description' => 'Curado por 7 días y ahumado con madera de cerezo.',
            'price' => 798.00,
            'stock' => 30,
            'image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBHiiDUeMT29f-Xx7m2ZX4vzltteih6eny5BlTp_TYBPA1TLna5FCOJqvHqXBXVzEBvzAT-FSXtdhKAyv5UwGUfUBFRKuT9N3PO5vOaf5lmSmj_ev4nJRiMB5zBE4mINCvbWXPtSLbEvSZyb5CP_YaVV86Wk8E5sPPx-NmXqrdJ_qBtlhSmG6ZG-EN8aurT9xhAAzDrbmIBSlZpqowtVBndA3V2dxX4JETtUyVxnNS6PdIfnpzsnja1wujPPNb12-ao4Z68t04010S4'
        ]);

        Product::create([
            'category_id' => $cat3->id,
            'title' => 'Pack Selección Premium',
            'description' => 'Cortes con mezcla secreta de roble y cerezo.',
            'price' => 3249.00,
            'stock' => 15,
            'image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBVbeNIKrDcaBYXu9k9XVzxjUU8VUdsQ6uOzSZxFw3D7KDanEiPHVj9cRnfYn9oC09xWsUZC53z9_NGN4Y6axgoe1eKWBdV82w_JQ1I1t0hB3zFmkwibB8N6mjJZRlV92lOOQjnzhTjaIDi7xZzM3zync8jzAUvMYikk2Gn6mWjRaumbwQ97pIJUy5E8hNd9gGUhTi_MFXQ7JEbPZkxa0PNZEBFlhvwJfIRxyDX09EvEFs7Tdp1-wcpSO7ZMNulyrYKS3r7c8IWSZ41'
        ]);
    }
}
