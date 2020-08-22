<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    $nombre = $faker->name;
    return [
        // SENTENCE sirve para generar oración aleatoria. Pasando un número como primer argumento a sentence podemos indicar el número de palabras que queremos que contenga la oración: $faker->sentence(3). Esto devolverá oraciones con 2, 3 o 4 palabras, o si queremos estrictamente que sean 3 palabras podemos llamar al método de esta forma: $faker->sentence(3, false)
        'name' => $faker->unique()->sentence(3),
        'slug' => $faker->unique()->slug,
        'author' => $faker->name(),
        'category' => '{"terror":1, "history":1, "drama":1 }',
        'user' => $faker->numberBetween(1, 5),
        'published_date' => $faker->dateTime($max = 'now', null)
    ];
});
