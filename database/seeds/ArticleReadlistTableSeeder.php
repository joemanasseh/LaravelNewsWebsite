<?php

use Illuminate\Database\Seeder;

class ArticleReadlistTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('article_readlist')->delete();
        
        
        
    }
}