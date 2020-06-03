<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Création des rôles */

        DB::table('role')->insert([
            'role_name' => 'admin'
        ]);

        DB::table('role')->insert([
            'role_name' => 'utilisateur'
        ]);

        /* Création des catégories */

        $id = DB::table('category')->insertGetId([
            'category_name' => 'Audio',
            'category_icon' => 'audiotrack'
        ]);

        DB::table('category')->insert([
            'category_name' => 'Album',
            'category_parent_id' => $id
        ]);

        DB::table('category')->insert([
            'category_name' => 'Audiobook',
            'category_parent_id' => $id
        ]);

        DB::table('category')->insert([
            'category_name' => 'Saga',
            'category_parent_id' => $id
        ]);
        
        $id = DB::table('category')->insertGetId([
            'category_name' => 'Vidéo',
            'category_icon' => 'movie'
        ]);

        DB::table('category')->insert([
            'category_name' => 'Série',
            'category_parent_id' => $id
        ]);

        DB::table('category')->insert([
            'category_name' => 'Anime',
            'category_parent_id' => $id
        ]);

        DB::table('category')->insert([
            'category_name' => 'Film',
            'category_parent_id' => $id
        ]);
        
        $id = DB::table('category')->insertGetId([
            'category_name' => 'Livre',
            'category_icon' => 'menu_book',
            'category_allow_collection' => TRUE
        ]);

        DB::table('category')->insert([
            'category_name' => 'Livre',
            'category_parent_id' => $id,
            'category_allow_collection' => TRUE
        ]);

        DB::table('category')->insert([
            'category_name' => 'Comics',
            'category_parent_id' => $id,
            'category_allow_collection' => TRUE
        ]);

        DB::table('category')->insert([
            'category_name' => 'Manga',
            'category_parent_id' => $id,
            'category_allow_collection' => TRUE
        ]);

        DB::table('category')->insert([
            'category_name' => 'BD',
            'category_parent_id' => $id,
            'category_allow_collection' => TRUE
        ]);
        
        $id = DB::table('category')->insertGetId([
            'category_name' => 'Jeux',
            'category_icon' => 'gamepad'
        ]);

         DB::table('category')->insert([
            'category_name' => 'Jeux vidéo',
            'category_parent_id' => $id
        ]);

        DB::table('category')->insert([
            'category_name' => 'Jeux de plateau',
            'category_parent_id' => $id
        ]);

        DB::table('category')->insert([
            'category_name' => 'Jeux de rôle',
            'category_parent_id' => $id
        ]);
        
    }
}
