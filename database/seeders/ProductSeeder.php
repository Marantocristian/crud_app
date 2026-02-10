<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Laptop Dell XPS 15',
                'description' => 'Laptop de alto rendimiento con procesador Intel i7, 16GB RAM y SSD 512GB',
                'price' => 1299.99,
                'quantity' => 15
            ],
            [
                'name' => 'Mouse Logitech MX Master 3',
                'description' => 'Mouse ergonómico inalámbrico con precisión avanzada',
                'price' => 99.99,
                'quantity' => 45
            ],
            [
                'name' => 'Teclado Mecánico RGB',
                'description' => 'Teclado mecánico con iluminación RGB personalizable y switches Cherry MX',
                'price' => 149.99,
                'quantity' => 8
            ],
            [
                'name' => 'Monitor Samsung 27"',
                'description' => 'Monitor 4K UHD de 27 pulgadas con HDR y 144Hz',
                'price' => 399.99,
                'quantity' => 12
            ],
            [
                'name' => 'Auriculares Sony WH-1000XM4',
                'description' => 'Auriculares inalámbricos con cancelación de ruido líder en la industria',
                'price' => 349.99,
                'quantity' => 0
            ],
            [
                'name' => 'Webcam Logitech C920',
                'description' => 'Webcam Full HD 1080p con micrófono estéreo',
                'price' => 79.99,
                'quantity' => 25
            ],
            [
                'name' => 'SSD Samsung 1TB',
                'description' => 'Unidad de estado sólido NVMe M.2 de 1TB con velocidad de lectura de 3500 MB/s',
                'price' => 129.99,
                'quantity' => 5
            ],
            [
                'name' => 'Hub USB-C 7 en 1',
                'description' => 'Hub multipuerto con HDMI, USB 3.0, lector SD y carga PD',
                'price' => 49.99,
                'quantity' => 30
            ],
            [
                'name' => 'Silla Ergonómica Herman Miller',
                'description' => 'Silla de oficina ergonómica con soporte lumbar ajustable',
                'price' => 899.99,
                'quantity' => 0
            ],
            [
                'name' => 'Lámpara LED Escritorio',
                'description' => 'Lámpara LED regulable con control táctil y puerto USB',
                'price' => 39.99,
                'quantity' => 60
            ],
            [
                'name' => 'Cable HDMI 2.1',
                'description' => 'Cable HDMI 2.1 de 2 metros compatible con 8K',
                'price' => 19.99,
                'quantity' => 100
            ],
            [
                'name' => 'Batería Externa 20000mAh',
                'description' => 'Power bank de alta capacidad con carga rápida',
                'price' => 39.99,
                'quantity' => 3
            ],
            [
                'name' => 'Soporte para Laptop',
                'description' => 'Soporte ergonómico ajustable de aluminio',
                'price' => 34.99,
                'quantity' => 18
            ],
            [
                'name' => 'Micrófono Blue Yeti',
                'description' => 'Micrófono USB profesional con múltiples patrones de grabación',
                'price' => 129.99,
                'quantity' => 7
            ],
            [
                'name' => 'Alfombrilla XL Gaming',
                'description' => 'Alfombrilla extendida de gaming con base antideslizante',
                'price' => 24.99,
                'quantity' => 42
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
