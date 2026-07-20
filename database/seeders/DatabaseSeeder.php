<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@look141.ps'],
            ['name' => 'Look.141 Admin', 'password' => Hash::make('admin123'), 'role' => 'admin']
        );

        // Categories
        $cats = [
            ['name' => 'الملابس النسائية', 'name_he' => 'בגדי נשים',  'name_en' => "Women's Clothing", 'icon' => '👗', 'key' => 'women-clothing', 'sort_order' => 1],
            ['name' => 'شنط نسائية',       'name_he' => 'תיקי נשים',  'name_en' => "Women's Bags",     'icon' => '👜', 'key' => 'women-bags',     'sort_order' => 2],
            ['name' => 'الأحذية النسائية', 'name_he' => 'נעלי נשים',  'name_en' => "Women's Shoes",    'icon' => '👠', 'key' => 'women-shoes',    'sort_order' => 3],
            ['name' => 'الملابس الرجالية', 'name_he' => 'בגדי גברים', 'name_en' => "Men's Clothing",   'icon' => '👔', 'key' => 'men-clothing',   'sort_order' => 4],
            ['name' => 'الأحذية الرجالية', 'name_he' => 'נעלי גברים', 'name_en' => "Men's Shoes",      'icon' => '👞', 'key' => 'men-shoes',      'sort_order' => 5],
            ['name' => 'أطفال',             'name_he' => 'ילדים',      'name_en' => 'Kids',              'icon' => '🧒', 'key' => 'kids',           'sort_order' => 6],
        ];

        foreach ($cats as $cat) {
            Category::updateOrCreate(['key' => $cat['key']], $cat);
        }

        $womenClothing = Category::where('key', 'women-clothing')->first()->id;
        $womenBags     = Category::where('key', 'women-bags')->first()->id;
        $womenShoes    = Category::where('key', 'women-shoes')->first()->id;
        $menClothing   = Category::where('key', 'men-clothing')->first()->id;
        $menShoes      = Category::where('key', 'men-shoes')->first()->id;
        $kids          = Category::where('key', 'kids')->first()->id;

        // Brands
        $brands = [
            ['name' => 'Nike',        'sort_order' => 1],
            ['name' => 'Adidas',      'sort_order' => 2],
            ['name' => 'Zara',        'sort_order' => 3],
            ['name' => 'U.S Polo',    'sort_order' => 4],
            ['name' => 'The North Face', 'sort_order' => 5],
            ['name' => 'Timberland',  'sort_order' => 6],
            ['name' => 'Balenciaga',  'sort_order' => 7],
            ['name' => 'Dr Martens',  'sort_order' => 8],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(['name' => $brand['name']], $brand);
        }

        $nike      = Brand::where('name', 'Nike')->first()->id;
        $adidas    = Brand::where('name', 'Adidas')->first()->id;
        $zara      = Brand::where('name', 'Zara')->first()->id;
        $usPolo    = Brand::where('name', 'U.S Polo')->first()->id;
        $timberland = Brand::where('name', 'Timberland')->first()->id;

        // Products (+ variants)
        $products = [
            [
                'category_id' => $womenClothing, 'brand_id' => $adidas,
                'name' => 'طقم رياضي أديداس نسائي', 'description' => 'طقم جاكيت وبنطلون رياضي، قماش قطن مرن',
                'badge' => 'خصم', 'price' => 180, 'compare_price' => 250, 'sort_order' => 1,
                'variants' => [
                    ['size' => 'S', 'color' => 'أسود'], ['size' => 'M', 'color' => 'أسود'],
                    ['size' => 'L', 'color' => 'أسود'], ['size' => 'S', 'color' => 'كحلي'],
                    ['size' => 'M', 'color' => 'كحلي'], ['size' => 'L', 'color' => 'كحلي'],
                ],
            ],
            [
                'category_id' => $womenClothing, 'brand_id' => $zara,
                'name' => 'فستان كاجوال صيفي', 'description' => 'قماش خفيف مناسب للصيف، قصة واسعة',
                'badge' => 'جديد', 'price' => 120, 'compare_price' => null, 'sort_order' => 2,
                'variants' => [
                    ['size' => 'S', 'color' => 'بيج'], ['size' => 'M', 'color' => 'بيج'],
                    ['size' => 'L', 'color' => 'بيج'], ['size' => 'M', 'color' => 'أسود'],
                ],
            ],
            [
                'category_id' => $womenBags, 'brand_id' => $zara,
                'name' => 'شنطة يد جلد', 'description' => 'شنطة يد جلد صناعي فاخر، تتحمل الاستخدام اليومي',
                'badge' => null, 'price' => 150, 'compare_price' => null, 'sort_order' => 1,
                'variants' => [
                    ['size' => 'مقاس واحد', 'color' => 'أسود'], ['size' => 'مقاس واحد', 'color' => 'بني'],
                ],
            ],
            [
                'category_id' => $womenShoes, 'brand_id' => $nike,
                'name' => 'حذاء رياضي أبيض نسائي', 'description' => 'حذاء رياضي خفيف مريح للاستخدام اليومي',
                'badge' => 'جديد', 'price' => 220, 'compare_price' => null, 'sort_order' => 1,
                'variants' => [
                    ['size' => '36', 'color' => 'أبيض'], ['size' => '37', 'color' => 'أبيض'],
                    ['size' => '38', 'color' => 'أبيض'], ['size' => '39', 'color' => 'أبيض'],
                    ['size' => '40', 'color' => 'أبيض'],
                ],
            ],
            [
                'category_id' => $womenShoes, 'brand_id' => null,
                'name' => 'كوتشي كاجوال', 'description' => 'كوتشي كاجوال بتصميم عصري',
                'badge' => 'خصم', 'price' => 180, 'compare_price' => 230, 'sort_order' => 2,
                'variants' => [
                    ['size' => '37', 'color' => 'وردي'], ['size' => '38', 'color' => 'وردي'],
                    ['size' => '39', 'color' => 'وردي'],
                ],
            ],
            [
                'category_id' => $menClothing, 'brand_id' => $usPolo,
                'name' => 'طقم رياضي US Polo', 'description' => 'طقم رياضي رجالي، قماش تراكسوت أصلي',
                'badge' => null, 'price' => 200, 'compare_price' => null, 'sort_order' => 1,
                'variants' => [
                    ['size' => 'M', 'color' => 'أخضر'], ['size' => 'L', 'color' => 'أخضر'],
                    ['size' => 'XL', 'color' => 'أخضر'], ['size' => 'L', 'color' => 'كحلي'],
                    ['size' => 'XL', 'color' => 'كحلي'],
                ],
            ],
            [
                'category_id' => $menClothing, 'brand_id' => $zara,
                'name' => 'قميص كلاسيك', 'description' => 'قميص قطني كلاسيك مناسب للعمل والمناسبات',
                'badge' => null, 'price' => 90, 'compare_price' => null, 'sort_order' => 2,
                'variants' => [
                    ['size' => 'M', 'color' => 'أبيض'], ['size' => 'L', 'color' => 'أبيض'],
                    ['size' => 'XL', 'color' => 'أبيض'],
                ],
            ],
            [
                'category_id' => $menShoes, 'brand_id' => $adidas,
                'name' => 'حذاء أديداس رياضي رجالي', 'description' => 'حذاء رياضي بتصميم عصري ونعل مريح',
                'badge' => 'الأكثر مبيعاً', 'price' => 250, 'compare_price' => 320, 'sort_order' => 1,
                'variants' => [
                    ['size' => '40', 'color' => 'أسود'], ['size' => '41', 'color' => 'أسود'],
                    ['size' => '42', 'color' => 'أسود'], ['size' => '43', 'color' => 'أسود'],
                    ['size' => '44', 'color' => 'أسود'],
                ],
            ],
            [
                'category_id' => $menShoes, 'brand_id' => $timberland,
                'name' => 'بوت تمبرلاند', 'description' => 'بوت جلد طبيعي مقاوم للماء',
                'badge' => 'جديد', 'price' => 380, 'compare_price' => null, 'sort_order' => 2,
                'variants' => [
                    ['size' => '40', 'color' => 'بني'], ['size' => '41', 'color' => 'بني'],
                    ['size' => '42', 'color' => 'بني'], ['size' => '43', 'color' => 'بني'],
                ],
            ],
            [
                'category_id' => $kids, 'brand_id' => $adidas,
                'name' => 'طقم أطفال رياضي', 'description' => 'طقم رياضي مريح للأطفال، قماش قطن',
                'badge' => null, 'price' => 90, 'compare_price' => null, 'sort_order' => 1,
                'variants' => [
                    ['size' => '4-6 سنوات', 'color' => 'أزرق'], ['size' => '7-9 سنوات', 'color' => 'أزرق'],
                    ['size' => '10-12 سنوات', 'color' => 'أزرق'],
                ],
            ],
        ];

        foreach ($products as $data) {
            $variants = $data['variants'];
            unset($data['variants']);

            $product = Product::updateOrCreate(
                ['category_id' => $data['category_id'], 'name' => $data['name']],
                $data
            );

            $product->variants()->delete();
            foreach ($variants as $i => $variant) {
                $product->variants()->create($variant + ['stock' => 20, 'sort_order' => $i]);
            }
        }
    }
}
