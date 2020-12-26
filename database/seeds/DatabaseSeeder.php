<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(SidebarsTableSeeder::class);
        $this->call(TopicsTableSeeder::class);
        $this->call(SubtopicsTableSeeder::class);
        $this->call(SubtopicTopicTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(ArticleReadlistTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(PinsTableSeeder::class);
        $this->call(ReadlistsTableSeeder::class);
        $this->call(SocialmediaTableSeeder::class);
    }
}
