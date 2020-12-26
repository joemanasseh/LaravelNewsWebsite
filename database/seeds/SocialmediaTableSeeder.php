<?php

use Illuminate\Database\Seeder;

class SocialmediaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('socialmedia')->delete();
        
        \DB::table('socialmedia')->insert(array (
            0 => 
            array (
                'id' => 4,
                'icon' => 'facebook f',
                'app' => 'Facebook',
                'username' => 'Daniel',
                'url' => 'facebook.com/Daniel',
                'user_id' => 8,
                'created_at' => '2019-11-03 19:24:37',
                'updated_at' => '2019-11-03 19:24:37',
            ),
            1 => 
            array (
                'id' => 5,
                'icon' => 'twitter',
                'app' => 'Twitter',
                'username' => 'Yusuf',
                'url' => 'twitter.com/Yusuf',
                'user_id' => 8,
                'created_at' => '2019-11-03 19:25:14',
                'updated_at' => '2019-11-03 19:25:14',
            ),
            2 => 
            array (
                'id' => 8,
                'icon' => 'facebook f',
                'app' => 'Facebook',
                'username' => 'Obi Gospel O',
                'url' => 'web.facebook.com/Obi.Gospel.O/',
                'user_id' => 1,
                'created_at' => '2019-11-17 14:42:03',
                'updated_at' => '2019-11-17 14:42:03',
            ),
            3 => 
            array (
                'id' => 9,
                'icon' => 'linkedin in',
                'app' => 'LinkedIn',
                'username' => 'Obi Gospel Ozioma',
                'url' => 'www.linkedin.com/in/obigospelozioma',
                'user_id' => 1,
                'created_at' => '2019-11-17 14:42:49',
                'updated_at' => '2019-11-17 14:42:49',
            ),
            4 => 
            array (
                'id' => 10,
                'icon' => 'twitter',
                'app' => 'Twitter',
                'username' => 'Obi Gospel Oz',
                'url' => 'twitter.com/obi_gospel_oz',
                'user_id' => 1,
                'created_at' => '2019-11-17 14:43:25',
                'updated_at' => '2019-11-17 14:43:25',
            ),
            5 => 
            array (
                'id' => 11,
                'icon' => 'pinterest p',
                'app' => 'Pinterest',
                'username' => 'Obi Gospel',
                'url' => 'www.pinterest.com/obigospel/',
                'user_id' => 1,
                'created_at' => '2019-11-17 14:51:18',
                'updated_at' => '2019-11-17 14:51:18',
            ),
            6 => 
            array (
                'id' => 12,
                'icon' => 'instagram',
                'app' => 'Instagram',
                'username' => 'Obi Gospel Oz',
                'url' => 'www.instagram.com/obigospeloz/',
                'user_id' => 1,
                'created_at' => '2019-11-17 14:52:10',
                'updated_at' => '2019-11-17 14:52:10',
            ),
            7 => 
            array (
                'id' => 13,
                'icon' => 'youtube',
                'app' => 'YouTube',
                'username' => 'Obi Gospel O.',
                'url' => 'www.youtube.com/channel/UComQiagh3pTj8TzYq0YMrOA',
                'user_id' => 1,
                'created_at' => '2019-11-17 14:52:57',
                'updated_at' => '2019-11-17 14:52:57',
            ),
            8 => 
            array (
                'id' => 14,
                'icon' => 'facebook f',
                'app' => 'Facebook',
                'username' => 'IABCAfrica',
                'url' => 'facebook.com/IABCAfrica',
                'user_id' => 11,
                'created_at' => '2019-11-19 13:12:22',
                'updated_at' => '2019-11-19 13:12:22',
            ),
            9 => 
            array (
                'id' => 15,
                'icon' => 'twitter',
                'app' => 'Twitter',
                'username' => 'IABC_Africa',
                'url' => 'twitter.com/IABC_Africa',
                'user_id' => 11,
                'created_at' => '2019-11-19 13:22:16',
                'updated_at' => '2019-11-19 13:22:16',
            ),
        ));
        
        
    }
}