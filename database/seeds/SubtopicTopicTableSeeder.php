<?php

use Illuminate\Database\Seeder;

class SubtopicTopicTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subtopic_topic')->delete();
        
        \DB::table('subtopic_topic')->insert(array (
            0 => 
            array (
                'id' => 16,
                'topic_id' => 8,
                'subtopic_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 17,
                'topic_id' => 8,
                'subtopic_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 18,
                'topic_id' => 5,
                'subtopic_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 19,
                'topic_id' => 7,
                'subtopic_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 21,
                'topic_id' => 10,
                'subtopic_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 25,
                'topic_id' => 5,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 26,
                'topic_id' => 9,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 27,
                'topic_id' => 6,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 28,
                'topic_id' => 2,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 29,
                'topic_id' => 13,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 30,
                'topic_id' => 15,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 31,
                'topic_id' => 1,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 32,
                'topic_id' => 7,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 33,
                'topic_id' => 8,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 34,
                'topic_id' => 10,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 35,
                'topic_id' => 11,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 36,
                'topic_id' => 12,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 37,
                'topic_id' => 4,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 38,
                'topic_id' => 3,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 39,
                'topic_id' => 14,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 40,
                'topic_id' => 10,
                'subtopic_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 41,
                'topic_id' => 8,
                'subtopic_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 42,
                'topic_id' => 5,
                'subtopic_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 43,
                'topic_id' => 16,
                'subtopic_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 44,
                'topic_id' => 16,
                'subtopic_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 45,
                'topic_id' => 18,
                'subtopic_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 46,
                'topic_id' => 18,
                'subtopic_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 47,
                'topic_id' => 18,
                'subtopic_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}