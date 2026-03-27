<?php

namespace Database\Seeders;

use App\Models\GameProduct;
use Illuminate\Database\Seeder;

class GameProductSeeder extends Seeder
{
    public function run(): void
    {
        $games = [
            [
                'name' => 'Grand Theft Auto V',
                'category' => 'Action',
                'description' => 'Jelajahi dunia Los Santos dalam petualangan open-world kriminal yang ikonik.',
                'stok' => 15,
                'harga' => 350000,
                'image' => 'products/gta5.jpg',
            ],
            [
                'name' => 'Minecraft',
                'category' => 'Sandbox',
                'description' => 'Bangun dunia impianmu, bertahan hidup dari monster, dan berkreasi tanpa batas.',
                'stok' => 25,
                'harga' => 120000,
                'image' => 'products/minecraft.jpg',
            ],
            [
                'name' => 'Elden Ring',
                'category' => 'RPG',
                'description' => 'Hadapi tantangan epik di dunia fantasi gelap ciptaan Hidetaka Miyazaki dan George R.R. Martin.',
                'stok' => 10,
                'harga' => 599000,
                'image' => 'products/elden_ring.jpg',
            ],
            [
                'name' => 'Valorant (Points)',
                'category' => 'FPS',
                'description' => 'Top up poin untuk skin senjata dan battle pass di game tactical shooter 5v5.',
                'stok' => 50,
                'harga' => 150000,
                'image' => 'products/valorant.jpg',
            ],
            [
                'name' => 'EA Sports FC 24',
                'category' => 'Sports',
                'description' => 'Rasakan pengalaman simulasi sepak bola paling realistis dengan fitur HyperMotionV.',
                'stok' => 20,
                'harga' => 750000,
                'image' => 'products/fc24.jpeg',
            ],
            [
                'name' => 'Resident Evil 4 Remake',
                'category' => 'Horror',
                'description' => 'Selamatkan putri presiden dari desa terpencil yang dipenuhi makhluk mengerikan.',
                'stok' => 8,
                'harga' => 800000,
                'image' => 'products/re4.jpg',
            ],
            [
                'name' => 'Cyberpunk 2077',
                'category' => 'RPG',
                'description' => 'Menjadi tentara bayaran di kota futuristik Night City yang penuh teknologi dan intrik.',
                'stok' => 12,
                'harga' => 450000,
                'image' => 'products/cyberpunk.jpeg',
            ],
            [
                'name' => 'Marvel Spider-Man 2',
                'category' => 'Action-Adventure',
                'description' => 'Berayun di New York sebagai Peter Parker dan Miles Morales melawan Venom.',
                'stok' => 10,
                'harga' => 850000,
                'image' => 'products/spiderman2.jpg',
            ],
            [
                'name' => 'God of War Ragnarok',
                'category' => 'Action',
                'description' => 'Perjalanan Kratos dan Atreus menghadapi takdir di sembilan alam mitologi Nordik.',
                'stok' => 7,
                'harga' => 700000,
                'image' => 'products/gow_ragnarok.jpeg',
            ],
            [
                'name' => 'Zelda: Tears of the Kingdom',
                'category' => 'Adventure',
                'description' => 'Eksplorasi daratan dan langit Hyrule dengan kekuatan kreativitas baru Link.',
                'stok' => 5,
                'harga' => 820000,
                'image' => 'products/zelda_tok.jpeg',
            ],
            [
                'name' => 'Forza Horizon 5',
                'category' => 'Racing',
                'description' => 'Balapan mobil mewah di pemandangan Meksiko yang menakjubkan dan dinamis.',
                'stok' => 18,
                'harga' => 600000,
                'image' => 'products/forza5.jpg',
            ],
            [
                'name' => 'Red Dead Redemption 2',
                'category' => 'Action',
                'description' => 'Kisah epik penjahat Arthur Morgan di masa akhir era Wild West Amerika.',
                'stok' => 15,
                'harga' => 400000,
                'image' => 'products/rdr2.jpg',
            ],
            [
                'name' => 'Stardew Valley',
                'category' => 'Simulation',
                'description' => 'Bangun kebun warisan kakekmu dan jalin persahabatan di desa Pelican Town.',
                'stok' => 30,
                'harga' => 95000,
                'image' => 'products/stardew.jpeg',
            ],
            [
                'name' => 'Tekken 8',
                'category' => 'Fighting',
                'description' => 'Pertarungan keluarga Mishima berlanjut dengan visual memukau dan sistem Heat baru.',
                'stok' => 10,
                'harga' => 650000,
                'image' => 'products/tekken8.jpg',
            ],
            // [
            //     'name' => 'It Takes Two',
            //     'category' => 'Adventure',
            //     'description' => 'Game kooperatif pemenang Game of the Year tentang petualangan pasangan kecil.',
            //     'stok' => 14,
            //     'harga' => 300000,
            //     'image' => 'products/ittakestwo.jpeg',
            // ],
        ];

        foreach ($games as $game) {
            GameProduct::create($game);
        }
    }
}
