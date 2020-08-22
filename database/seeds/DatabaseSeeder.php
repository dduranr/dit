<?php

use App\Book;
use Illuminate\Database\Seeder;
// use App\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        
        App\User::create([
            'name' => 'David Durán',
            'email' => 'official.dduran@gmail.com',
            'password' => Hash::make('abc123')
        ]);

        App\Book::create([
            'name' => 'La Ilíada',
            'slug' => 'la-iliada',
            'author' => 'Homero',
            'category' => 1,
            'borrow' => 1,
            'published_date' => '2020-08-20 20:51:19',
            'user' => 1
        ]);
        App\Book::create([
            'name' => 'La Odisea',
            'slug' => 'la-odisea',
            'author' => 'Homero',
            'category' => 1,
            'borrow' => 1,
            'published_date' => '2020-08-20 21:51:19',
            'user' => 1
        ]);
        App\Book::create([
            'name' => 'Diccionario de Filosofía',
            'slug' => 'diccionario-de-filosofia',
            'author' => 'Nicola Abbagnano',
            'category' => 2,
            'borrow' => 0,
            'published_date' => '2020-07-20 09:51:19',
            'user' => null
        ]);
        App\Book::create([
            'name' => 'Ética Nicomaquea',
            'slug' => 'etica-nicomaquea',
            'author' => 'Aristóteles',
            'category' => 3,
            'borrow' => 0,
            'published_date' => '2019-08-20 08:51:19',
            'user' => null
        ]);
        App\Book::create([
            'name' => 'Parerga y Paralipómena',
            'slug' => 'parerga-y-paralipomena',
            'author' => 'Schopenhauer',
            'category' => 3,
            'borrow' => 0,
            'published_date' => '2021-06-20 20:51:19',
            'user' => null
        ]);

        App\Category::create([
            'name' => 'Terror',
            'slug' => 'terror',
            'description' => 'Terror Lorem ipsum Dolor sit amet',
            'manybooks' => 1
        ]);
        App\Category::create([
            'name' => 'Classic',
            'slug' => 'classic',
            'description' => 'Classic Lorem ipsum Dolor sit amet',
            'manybooks' => 2
        ]);
        App\Category::create([
            'name' => 'Comedy',
            'slug' => 'comedy',
            'description' => 'Comedy Lorem ipsum Dolor sit amet',
            'manybooks' => 3
        ]);


    }
}
