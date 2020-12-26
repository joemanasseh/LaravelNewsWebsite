<?php

use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('topics')->delete();
        
        \DB::table('topics')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Inspiration',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 00:11:05',
                'updated_at' => '2019-06-26 00:11:05',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Leadership',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 00:11:28',
                'updated_at' => '2019-06-26 00:11:28',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Marketing',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 00:11:44',
                'updated_at' => '2019-06-26 00:11:44',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Social Media',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 00:12:13',
                'updated_at' => '2019-06-26 00:12:13',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Finance',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 00:12:33',
                'updated_at' => '2019-10-01 02:45:05',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Technology',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 00:13:03',
                'updated_at' => '2019-06-26 00:13:03',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Innovation',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 00:13:28',
                'updated_at' => '2019-06-26 00:13:28',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Entrepreneurs',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 00:13:44',
                'updated_at' => '2019-10-01 02:44:56',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Starting a Business',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 00:18:14',
                'updated_at' => '2019-06-26 00:18:14',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Africa\'s Economy',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 06:13:13',
                'updated_at' => '2019-07-18 19:51:18',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Manufacturing',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 07:02:29',
                'updated_at' => '2019-06-26 07:02:29',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Personal Development',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 09:17:54',
                'updated_at' => '2019-06-26 09:17:54',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Job Search',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 09:23:47',
                'updated_at' => '2019-06-26 09:23:47',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Startup',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 09:29:34',
                'updated_at' => '2019-06-26 09:29:34',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Investment',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-06-26 21:56:16',
                'updated_at' => '2019-06-26 21:56:16',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'dsdfsdfsdf',
                'status' => 'inactive',
                'sidebar' => 'visible',
                'created_at' => '2019-08-04 09:14:24',
                'updated_at' => '2019-10-02 20:33:08',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'aaaaa',
                'status' => 'inactive',
                'sidebar' => 'visible',
                'created_at' => '2019-08-04 09:14:46',
                'updated_at' => '2019-10-02 20:32:58',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Trending Business News',
                'status' => 'active',
                'sidebar' => 'visible',
                'created_at' => '2019-10-21 21:40:18',
                'updated_at' => '2019-10-21 21:40:18',
            ),
        ));
        
        
    }
}