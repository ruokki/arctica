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
        $this->createRole();
        $this->createAudio();
        $this->createVideo();
        $this->createBook();
        $this->createGame();
        
    }

    /* 
     * Création des rôles 
     */
    private function createRole() {
        DB::table('role')->insert([
            'role_name' => 'admin'
        ]);

        DB::table('role')->insert([
            'role_name' => 'utilisateur'
        ]);
    }

    /* 
     * Création de la catégorie Audio
     */
    private function createAudio() {

         $main = DB::table('category')->insertGetId([
            'category_name' => 'Audio',
            'category_icon' => 'audiotrack'
        ]);

        $id = DB::table('category')->insertGetId([
            'category_name' => 'Album',
            'category_parent_id' => $main
        ]);
        
        DB::table('field')->insert($this->getField('creator', $id, 'Groupe'));
        DB::table('field')->insert($this->getField('editor', $id));
        DB::table('field')->insert($this->getField('release', $id));
        DB::table('field')->insert($this->getField('tracklist', $id));


        $id = DB::table('category')->insertGetId([
            'category_name' => 'Audiobook',
            'category_parent_id' => $main
        ]);

        DB::table('field')->insert($this->getField('creator', $id, 'Auteur'));
        DB::table('field')->insert($this->getField('release', $id));
        DB::table('field')->insert($this->getField('universe', $id));

        $saga = DB::table('category')->insertGetId([
            'category_name' => 'Saga',
            'category_parent_id' => $main
        ]);

        DB::table('field')->insert($this->getField('creator', $id, 'Auteur'));
        DB::table('field')->insert($this->getField('release', $id));
    }

    /* 
     * Création de la catégorie Video
     */
    private function createVideo() {
        $main = DB::table('category')->insertGetId([
            'category_name' => 'Vidéo',
            'category_icon' => 'movie'
        ]);

        $id = DB::table('category')->insertGetId([
            'category_name' => 'Série',
            'category_parent_id' => $main
        ]);

        DB::table('field')->insert($this->getField('creator', $id, 'Créateur'));
        DB::table('field')->insert($this->getField('release', $id));
        DB::table('field')->insert($this->getField('type', $id, '', [
            'DVD',
            'Blu-Ray',
            'Démat'
        ]));

        $id = DB::table('category')->insertGetId([
            'category_name' => 'Anime',
            'category_parent_id' => $main
        ]);

        DB::table('field')->insert($this->getField('creator', $id, 'Studio'));
        DB::table('field')->insert($this->getField('release', $id));
        DB::table('field')->insert($this->getField('type', $id, '', [
            'DVD',
            'Blu-Ray',
            'Démat'
        ]));

        $id = DB::table('category')->insertGetId([
            'category_name' => 'Film',
            'category_parent_id' => $main
        ]);

        DB::table('field')->insert($this->getField('creator', $id, 'Studio'));
        DB::table('field')->insert($this->getField('release', $id));
        DB::table('field')->insert($this->getField('universe', $id));
        DB::table('field')->insert($this->getField('type', $id, '', [
            'DVD',
            'Blu-Ray',
            'Démat'
        ]));
    }

    /**
     * Création de la catégorie Livre
     */
    private function createBook() {
        $main = DB::table('category')->insertGetId([
            'category_name' => 'Livre',
            'category_icon' => 'menu_book',
            'category_allow_collection' => TRUE
        ]);

        $id = DB::table('category')->insertGetId([
            'category_name' => 'Livre',
            'category_parent_id' => $main,
            'category_allow_collection' => TRUE
        ]);

        DB::table('field')->insert($this->getField('creator', $id, 'Auteur'));
        DB::table('field')->insert($this->getField('editor', $id));
        DB::table('field')->insert($this->getField('release', $id));
        DB::table('field')->insert($this->getField('idx_collection', $id));

        $id = DB::table('category')->insertGetId([
            'category_name' => 'Comics',
            'category_parent_id' => $main,
            'category_allow_collection' => TRUE
        ]);

        DB::table('field')->insert($this->getField('creator', $id, 'Auteur'));
        DB::table('field')->insert($this->getField('editor', $id));
        DB::table('field')->insert($this->getField('release', $id));
        DB::table('field')->insert($this->getField('idx_collection', $id));

        $id = DB::table('category')->insertGetId([
            'category_name' => 'Manga',
            'category_parent_id' => $main,
            'category_allow_collection' => TRUE
        ]);

        DB::table('field')->insert($this->getField('creator', $id, 'Auteur'));
        DB::table('field')->insert($this->getField('editor', $id));
        DB::table('field')->insert($this->getField('release', $id));
        DB::table('field')->insert($this->getField('idx_collection', $id));
        
        $id = DB::table('category')->insertGetId([
            'category_name' => 'BD',
            'category_parent_id' => $main,
            'category_allow_collection' => TRUE
            ]);

        DB::table('field')->insert($this->getField('creator', $id, 'Auteur'));
        DB::table('field')->insert($this->getField('editor', $id));
        DB::table('field')->insert($this->getField('release', $id));
        DB::table('field')->insert($this->getField('idx_collection', $id));
    }

    /**
     * Création de la catégorie Jeux
     */
    private function createGame() {
        $main = DB::table('category')->insertGetId([
            'category_name' => 'Jeux',
            'category_icon' => 'gamepad'
        ]);

         $id = DB::table('category')->insertGetId([
            'category_name' => 'Jeux vidéo',
            'category_parent_id' => $main
        ]);

        DB::table('field')->insert($this->getField('creator', $id, 'Studio'));
        DB::table('field')->insert($this->getField('universe', $id));
        DB::table('field')->insert($this->getField('editor', $id));
        DB::table('field')->insert($this->getField('release', $id));
        DB::table('field')->insert($this->getField('type', $id, '', [
            'PS1',
            'PS2',
            'PS3',
            'PS4',
            'XBox',
            'XBox360',
            'XBoxOne',
            'NES',
            'SNES',
            'Nintendo 64',
            'GameCube',
            'Wii',
            'Wii U',
            'Switch',
            'PC'
        ]));

        $id = DB::table('category')->insertGetId([
            'category_name' => 'Jeux de plateau',
            'category_parent_id' => $main
        ]);

        DB::table('field')->insert($this->getField('creator', $id, 'Éditeur'));
        DB::table('field')->insert($this->getField('release', $id));

        $id = DB::table('category')->insertGetId([
            'category_name' => 'Jeux de rôle',
            'category_parent_id' => $main
        ]);

        DB::table('field')->insert($this->getField('creator', $id, 'Éditeur'));
        DB::table('field')->insert($this->getField('release', $id));
    }

    /**
     * Génération des infos pour insérer un field en fonction du type
     */
    private function getField($type, $idCat, $label = '', $options = []) {
        $field = [];
        if($type === 'creator') {
            $field = [
                'field_name' => 'item_creator',
                'field_label' => 'Créateur',
                'field_type' => 'text'
            ];
        }
        else if($type === 'editor') {
            $field = [
                'field_name' => 'item_editor',
                'field_label' => 'Éditeur',
                'field_type' => 'text'
            ];
        }
        else if($type === 'release') {
            $field = [
                'field_name' => 'item_release',
                'field_label' => 'Année de sortie',
                'field_type' => 'number'
            ];
        }
        else if($type === 'tracklist') {
            $field = [
                'field_name' => 'item_tracklist',
                'field_label' => 'Liste des pistes',
                'field_type' => 'textarea'
            ];
        }
        else if($type === 'idx_collection') {
            $field = [
                'field_name' => 'item_idx_collection',
                'field_label' => 'Numéro du tome',
                'field_type' => 'number'
            ];
        }
        else if($type === 'universe') {
            $field = [
                'field_name' => 'item_universe',
                'field_label' => 'Série',
                'field_type' => 'number'
            ];
        }
        else if($type === 'type') {
            $field = [
                'field_name' => 'item_type',
                'field_label' => 'Type',
                'field_type' => 'select',
                'field_options' => json_encode([])
            ];
        }

        $field['category_id'] = $idCat;

        if($label !== '') {
            $field['field_label'] = $label;
        }

        if(count($options) > 0) {
            $field['field_options'] = json_encode($options);
        }

        return $field;
    }
}
