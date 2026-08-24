<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $catId = fn (string $name) => Category::where('name', $name)->value('id');

        $products = [
            // ================= CELULARES =================
            [
                'cat' => 'Celulares',
                'name' => 'Apple iPhone 15 Pro Max 256GB Titanio Natural',
                'description' => 'Smartphone Apple con chip A17 Pro, pantalla Super Retina XDR OLED de 6.7 pulgadas, marco de titanio aeroespacial y sistema de cámaras Pro de 48 MP.',
                'price' => 749900,
                'stock' => 15,
                'img' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Celulares',
                'name' => 'Samsung Galaxy S24 Ultra 512GB Titanium Black',
                'description' => 'Dispositivo premium Samsung con Galaxy AI integrada, procesador Snapdragon 8 Gen 3, pantalla Dynamic AMOLED 2X de 6.8 pulgadas y S Pen incorporado.',
                'price' => 689900,
                'stock' => 20,
                'img' => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Celulares',
                'name' => 'Google Pixel 8 Pro 128GB Obsidian',
                'description' => 'Teléfono insignia de Google con procesador Tensor G3, la mejor fotografía computacional con IA, sensor de temperatura y pantalla Actua de 6.7 pulgadas a 120Hz.',
                'price' => 489900,
                'stock' => 18,
                'img' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Celulares',
                'name' => 'Xiaomi 14 Ultra 512GB Black',
                'description' => 'Fotografía profesional Leica con sensor de 1 pulgada, procesador Snapdragon 8 Gen 3, carga hiper rápida de 90W y pantalla AMOLED WQHD+.',
                'price' => 559900,
                'stock' => 12,
                'img' => 'https://images.unsplash.com/photo-1580910051074-3eb694886505?q=80&w=800&auto=format&fit=crop',
            ],

            // ================= LAPTOPS =================
            [
                'cat' => 'Laptops',
                'name' => 'Apple MacBook Pro 14" Chip M3 Pro (18GB RAM / 512GB SSD)',
                'description' => 'Potencia profesional extrema con pantalla Liquid Retina XDR de 14 pulgadas, autonomía de hasta 18 horas y acabado Space Black.',
                'price' => 1150000,
                'stock' => 8,
                'img' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Laptops',
                'name' => 'ASUS ROG Zephyrus G16 (Intel Core i9 / RTX 4080 / 32GB RAM / 1TB SSD)',
                'description' => 'Portátil gaming de alto rendimiento con pantalla OLED ROG Nebula 2.5K a 240Hz, refrigeración líquida inteligente y chasis de aluminio ultrafino.',
                'price' => 1399900,
                'stock' => 6,
                'img' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Laptops',
                'name' => 'Dell XPS 13 Plus (Intel Core i7 13va Gen / 16GB RAM / 512GB SSD)',
                'description' => 'Diseño minimalista premium con panel táctil de cristal continuo, pantalla táctil OLED InfinityEdge 4K y teclado táctil capacitivo.',
                'price' => 789900,
                'stock' => 10,
                'img' => 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Laptops',
                'name' => 'Lenovo ThinkPad X1 Carbon Gen 11 (Intel Core i7 / 16GB / 512GB SSD)',
                'description' => 'La laptop empresarial por excelencia: ultraliviana en fibra de carbono, durabilidad de grado militar MIL-STD-810H y seguridad ThinkShield.',
                'price' => 850000,
                'stock' => 9,
                'img' => 'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?q=80&w=800&auto=format&fit=crop',
            ],

            // ================= AUDIO =================
            [
                'cat' => 'Audio',
                'name' => 'Audífonos Inalámbricos Sony WH-1000XM5 con Cancelación de Ruido',
                'description' => 'Cancelación de ruido líder en la industria con dos procesadores y 8 micrófonos, audio de alta resolución LDAC y hasta 30 horas de batería.',
                'price' => 195000,
                'stock' => 30,
                'img' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Audio',
                'name' => 'Apple AirPods Pro 2.ª Generación con Estuche MagSafe USB-C',
                'description' => 'Audio espacial personalizado con seguimiento dinámico de la cabeza, cancelación activa de ruido 2x superior y modo ambiente adaptativo.',
                'price' => 145000,
                'stock' => 45,
                'img' => 'https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Audio',
                'name' => 'Parlante Portátil Bluetooth JBL Charge 5 Waterproof',
                'description' => 'Sonido potente JBL Original Pro Sound con driver de gran excursión, resistencia al agua y polvo IP67 y powerbank integrado.',
                'price' => 89900,
                'stock' => 35,
                'img' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Audio',
                'name' => 'Parlante Inteligente Amazon Echo Studio con Alexa y Sonido Hi-Fi',
                'description' => '5 altavoces direccionales para sonido inmersivo 3D con Dolby Atmos y calibración acústica automática para la habitación.',
                'price' => 119900,
                'stock' => 25,
                'img' => 'https://images.unsplash.com/photo-1543512214-318c7553f230?q=80&w=800&auto=format&fit=crop',
            ],

            // ================= GAMING =================
            [
                'cat' => 'Gaming',
                'name' => 'Consola Sony PlayStation 5 Slim 1TB SSD',
                'description' => 'Disfruta de juegos en 4K hasta 120 fps con trazado de rayos acelerado por hardware, disco SSD ultrarrápido y retrocompatibilidad con PS4.',
                'price' => 365000,
                'stock' => 14,
                'img' => 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Gaming',
                'name' => 'Consola Nintendo Switch Modelo OLED (Blanco)',
                'description' => 'Pantalla OLED vibrante de 7 pulgadas, soporte ancho ajustable, base con puerto LAN por cable y 64 GB de almacenamiento interno.',
                'price' => 215000,
                'stock' => 22,
                'img' => 'https://images.unsplash.com/photo-1578303512597-81e6cc155b3e?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Gaming',
                'name' => 'Control Inalámbrico Sony DualSense PS5 Midnight Black',
                'description' => 'Gatillos adaptativos dinámicos, retroalimentación háptica inmersiva, micrófono integrado y botón Crear en un diseño ergonómico color negro medianoche.',
                'price' => 44900,
                'stock' => 50,
                'img' => 'https://images.unsplash.com/photo-1592840496694-26d035b52b48?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Gaming',
                'name' => 'Control Inalámbrico Xbox Series X/S Robot White',
                'description' => 'Agarre texturizado en gatillos y botones superiores, cruceta híbrida precisa, botón Compartir dedicado y conexión Bluetooth para PC y móvil.',
                'price' => 39900,
                'stock' => 50,
                'img' => 'https://images.unsplash.com/photo-1600080972464-8e5f35f63d08?q=80&w=800&auto=format&fit=crop',
            ],

            // ================= ACCESORIOS =================
            [
                'cat' => 'Accesorios',
                'name' => 'Cargador Rápido Anker 737 GaNPrime 120W (3 Puertos)',
                'description' => 'Cargador multipuerto ultracompacto GaNPrime capaz de alimentar laptops, tablets y smartphones simultáneamente a máxima velocidad.',
                'price' => 39900,
                'stock' => 80,
                'img' => 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Accesorios',
                'name' => 'Batería Portátil Anker PowerCore 24000mAh 140W PD',
                'description' => 'Power Bank de alta potencia con pantalla digital inteligente, recarga bidireccional ultrarrápida y capacidad para cargar una laptop completa.',
                'price' => 65000,
                'stock' => 40,
                'img' => 'https://images.unsplash.com/photo-1622445262464-84b1456045b6?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Accesorios',
                'name' => 'Mouse Ergonómico Inalámbrico Logitech MX Master 3S',
                'description' => 'Sensor óptico Darkfield de 8000 DPI que funciona sobre cristal, clics silenciosos Quiet Clicks y rueda de desplazamiento electromagnética MagSpeed.',
                'price' => 62000,
                'stock' => 30,
                'img' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'cat' => 'Accesorios',
                'name' => 'Teclado Mecánico Inalámbrico Keychron K2 RGB (Gateron Brown)',
                'description' => 'Teclado mecánico compacto del 75% compatible con Mac y Windows, conexión Bluetooth 5.1/USB-C y retroiluminación RGB personalizable.',
                'price' => 54900,
                'stock' => 25,
                'img' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?q=80&w=800&auto=format&fit=crop',
            ],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'category_id' => $catId($p['cat']),
                    'name' => $p['name'],
                    'description' => $p['description'],
                    'price' => $p['price'],
                    'stock' => $p['stock'],
                    'image_url' => $p['img'],
                    'active' => true,
                ]
            );
        }
    }
}
