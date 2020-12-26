<?php

use Illuminate\Database\Seeder;

class ReadlistsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('readlists')->delete();
        
        \DB::table('readlists')->insert(array (
            0 => 
            array (
                'id' => 3,
                'user_id' => 11,
                'articles_id' => 4,
                'created_at' => '2019-10-03 10:37:49',
                'updated_at' => '2019-10-03 10:37:49',
            ),
            1 => 
            array (
                'id' => 4,
                'user_id' => 11,
                'articles_id' => 3,
                'created_at' => '2019-10-03 10:38:03',
                'updated_at' => '2019-10-03 10:38:03',
            ),
            2 => 
            array (
                'id' => 5,
                'user_id' => 11,
                'articles_id' => 7,
                'created_at' => '2019-10-03 10:38:31',
                'updated_at' => '2019-10-03 10:38:31',
            ),
            3 => 
            array (
                'id' => 6,
                'user_id' => 11,
                'articles_id' => 8,
                'created_at' => '2019-10-03 10:38:54',
                'updated_at' => '2019-10-03 10:38:54',
            ),
            4 => 
            array (
                'id' => 7,
                'user_id' => 11,
                'articles_id' => 11,
                'created_at' => '2019-10-03 10:39:14',
                'updated_at' => '2019-10-03 10:39:14',
            ),
            5 => 
            array (
                'id' => 8,
                'user_id' => 11,
                'articles_id' => 9,
                'created_at' => '2019-10-03 10:39:57',
                'updated_at' => '2019-10-03 10:39:57',
            ),
            6 => 
            array (
                'id' => 9,
                'user_id' => 11,
                'articles_id' => 5,
                'created_at' => '2019-10-03 10:40:24',
                'updated_at' => '2019-10-03 10:40:24',
            ),
            7 => 
            array (
                'id' => 10,
                'user_id' => 11,
                'articles_id' => 10,
                'created_at' => '2019-10-03 10:40:50',
                'updated_at' => '2019-10-03 10:40:50',
            ),
            8 => 
            array (
                'id' => 11,
                'user_id' => 11,
                'articles_id' => 13,
                'created_at' => '2019-10-03 10:41:10',
                'updated_at' => '2019-10-03 10:41:10',
            ),
            9 => 
            array (
                'id' => 12,
                'user_id' => 11,
                'articles_id' => 14,
                'created_at' => '2019-10-03 10:41:26',
                'updated_at' => '2019-10-03 10:41:26',
            ),
            10 => 
            array (
                'id' => 13,
                'user_id' => 1,
                'articles_id' => 5,
                'created_at' => '2019-10-05 18:21:30',
                'updated_at' => '2019-10-05 18:21:30',
            ),
            11 => 
            array (
                'id' => 14,
                'user_id' => 1,
                'articles_id' => 18,
                'created_at' => '2020-01-01 13:23:51',
                'updated_at' => '2020-01-01 13:23:51',
            ),
        ));
        
        
    }
}