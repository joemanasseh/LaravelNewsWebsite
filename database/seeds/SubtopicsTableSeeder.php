<?php

use Illuminate\Database\Seeder;

class SubtopicsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subtopics')->delete();
        
        \DB::table('subtopics')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Dummy',
                'status' => 'active',
                'created_at' => '2019-06-26 06:14:25',
                'updated_at' => '2019-06-26 06:14:25',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Ugreen',
                'status' => 'inactive',
                'created_at' => '2019-07-02 06:13:30',
                'updated_at' => '2019-11-19 14:20:42',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Orico',
                'status' => 'active',
                'created_at' => '2019-07-02 06:13:53',
                'updated_at' => '2019-07-02 06:13:53',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Success Tips',
                'status' => 'active',
                'created_at' => '2019-11-19 13:42:48',
                'updated_at' => '2019-11-19 13:42:48',
            ),
        ));
        
        
    }
}