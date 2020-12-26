<?php

use Illuminate\Database\Seeder;

class SidebarsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sidebars')->delete();
        
        \DB::table('sidebars')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Africa’s Entrepreneur’s Profile',
                'link' => 'https://iabc_africa.com/...',
                'status' => 'active',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Women Entrepreneur',
                'link' => 'https://iabc_africa.com/...2',
                'status' => 'active',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Videos',
                'link' => 'https://iabc_africa.com/...3',
                'status' => 'active',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'IABC Africa 1000',
                'link' => 'https://iabc_africa.com/...4',
                'status' => 'active',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'AgriBusiness',
                'link' => 'https://iabc_africa.com/...5',
                'status' => 'active',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Opportunities',
                'link' => 'https://iabc_africa.com/...6',
                'status' => 'active',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Contact Us',
                'link' => 'https://iabc_africa.com/...7',
                'status' => 'active',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}