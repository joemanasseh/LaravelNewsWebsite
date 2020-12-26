<?php

use Illuminate\Database\Seeder;

class PasswordResetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('password_resets')->delete();
        
        \DB::table('password_resets')->insert(array (
            0 => 
            array (
                'email' => 'gospel@iabcafrica.com',
                'token' => '$2y$10$FIEmPami4NZukw5h75Njle2hJAQ2doR6ckCwJa9obt31GDO.HWdB.',
                'created_at' => '2019-10-01 00:26:53',
            ),
        ));
        
        
    }
}