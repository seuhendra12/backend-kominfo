<?php

namespace Database\Seeders;

use App\Models\Galeri;
use App\Models\Kategori;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat Tag 
		$tag = Tag::create([
            'name' => 'Kominfo Terkini',
            'slug' => 'kominfo-terkini'
        ]);

        // Membuat Kategori 
		$kategori = Kategori::create([
            'name' => 'Kominfo Digital',
            'slug' => 'kominfo-Digital'
        ]);

        // Membuat Kategori 
		$galeri = Galeri::create([
            'name' => 'Kominfo Digital Economy',
            'description' => 'Galeri Kominfo Digital Economy adalah galeri yang didedikasikan untuk memperkenalkan dan mempromosikan inovasi dan teknologi terkini yang berhubungan dengan ekonomi digital. Galeri ini menampilkan berbagai macam produk dan layanan digital yang berkaitan dengan ekonomi, seperti aplikasi e-commerce, fintech, marketplace, serta platform digital lainnya.'
        ]);
    }
}
