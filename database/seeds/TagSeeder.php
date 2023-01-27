<?php

use Illuminate\Database\Seeder;
use  App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Vegano',
            'Vegetariano',
            'Carne',
            'Pesce',
            'Senza Glutine'

        ];

        foreach ($tags as $tag) {
            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag->save();
        }
    }
}
