<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatRoomSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create some  default chat room for app

        DB::table('chat_rooms')->insert([
             'name' =>'General'
        ]);

        DB::table('chat_rooms')->insert([
            'name' =>'Tech Talk'
       ]);

    }
}
