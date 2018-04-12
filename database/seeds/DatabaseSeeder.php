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
        // $this->call(UsersTableSeeder::class);
        
        // Initiative types
        $initiativeTypes = array(0 => array('id' => 1, 'name' => 'Offers'),
                                 1 => array('id' => 2, 'name' => 'Demands'));

        for($i=0; $i<count($initiativeTypes); $i++) {
            DB::table('initiative_types')->insert([
                'id' => $initiativeTypes[$i]['id'],
                'name' => $initiativeTypes[$i]['name'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Initiative types translations
        for($i=0; $i<count($initiativeTypes); $i++) {
            DB::table('initiative_type_translations')->insert([
                'initiative_type_id' => $initiativeTypes[$i]['id'],
                'name' => $initiativeTypes[$i]['name'],
                'locale' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
