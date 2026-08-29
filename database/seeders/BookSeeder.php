<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'title' => '99 Names of Allah',
            'slug' => '99-names-of-allah',
            'image' => '99.jpg',
            'pdf' => '99-names-of-allah.pdf',
            'category' => 'Islamic',
            'author' => 'Sultana Quran Academy',
        ]);

        Book::create([
            'title' => 'Kalima',
            'slug' => 'kalima',
            'image' => 'kalima.jpg',
            'pdf' => 'kalima.pdf',
            'category' => 'Islamic',
            'author' => 'Islamic Center',
        ]);

        Book::create([
            'title' => 'Masnoon Dua',
            'slug' => 'masnoon-dua',
            'image' => 'masnoondua.jpg',
            'pdf' => 'masnoondua.pdf',
            'category' => 'Dua',
            'author' => 'Islamic Center',
        ]);

        Book::create([
            'title' => 'Namaz',
            'slug' => 'namaz',
            'image' => 'namaz.jpg',
            'pdf' => 'namaz.pdf',
            'category' => 'Prayer',
            'author' => 'Islamic Center',
        ]);

        Book::create([
            'title' => 'Qayda',
            'slug' => 'qayda',
            'image' => 'qaida.jpg',
            'pdf' => 'qaida.pdf',
            'category' => 'Quran',
            'author' => 'Islamic Center',
        ]);

        Book::create([
            'title' => 'Quran Majid',
            'slug' => 'quran-majid',
            'image' => 'quran.jpg',
            'pdf' => 'quran.pdf',
            'category' => 'Quran',
            'author' => 'Islamic Center',
        ]);
    }
}