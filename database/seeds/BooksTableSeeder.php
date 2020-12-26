<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('books')->delete();
        
        \DB::table('books')->insert(array (
            0 => 
            array (
                'id' => 4,
                'isbn' => '123432123432',
                'title' => 'Book 4',
                'cover' => '1569671797.jpg',
                'description' => 'This is what the book should look like',
                'rating' => 0,
                'author0' => 'Obi Gos gos gos',
                'author1' => NULL,
                'author2' => NULL,
                'author3' => NULL,
                'author4' => NULL,
                'author5' => NULL,
                'price' => NULL,
                'user_id' => 1,
                'created_at' => '2019-09-28 11:56:37',
                'updated_at' => '2019-09-28 11:56:37',
            ),
            1 => 
            array (
                'id' => 5,
                'isbn' => '2343454343232',
                'title' => 'The Jack',
                'cover' => '1569672551.jpg',
                'description' => 'This is test book 5. Work!',
                'rating' => 0,
                'author0' => 'Shuaib',
                'author1' => NULL,
                'author2' => NULL,
                'author3' => NULL,
                'author4' => NULL,
                'author5' => NULL,
                'price' => NULL,
                'user_id' => 1,
                'created_at' => '2019-09-28 12:09:11',
                'updated_at' => '2019-09-28 12:09:11',
            ),
            2 => 
            array (
                'id' => 7,
                'isbn' => '1234565656543',
                'title' => 'Book10',
                'cover' => 'book.jpg',
                'description' => 'This is my second to the final book test',
                'rating' => 0,
                'author0' => 'Obi David',
                'author1' => NULL,
                'author2' => NULL,
                'author3' => NULL,
                'author4' => NULL,
                'author5' => NULL,
                'price' => NULL,
                'user_id' => 1,
                'created_at' => '2019-09-29 17:22:59',
                'updated_at' => '2019-09-29 17:22:59',
            ),
            3 => 
            array (
                'id' => 8,
                'isbn' => '1234567876545',
                'title' => 'Book 2-0',
                'cover' => 'book.jpg',
                'description' => 'Well, final book test today',
                'rating' => 0,
                'author0' => 'Obi Nneka',
                'author1' => NULL,
                'author2' => NULL,
                'author3' => NULL,
                'author4' => NULL,
                'author5' => NULL,
                'price' => NULL,
                'user_id' => 1,
                'created_at' => '2019-09-29 17:24:02',
                'updated_at' => '2019-09-29 17:24:02',
            ),
            4 => 
            array (
                'id' => 9,
                'isbn' => '1234567656545',
                'title' => 'efsdfsdf',
                'cover' => 'book.jpg',
                'description' => 'sdfsdf sdfsd fsdf sdfsd sdfsd fsdf sd',
                'rating' => 0,
                'author0' => 'sfsfsf',
                'author1' => NULL,
                'author2' => NULL,
                'author3' => NULL,
                'author4' => NULL,
                'author5' => NULL,
                'price' => NULL,
                'user_id' => 1,
                'created_at' => '2019-09-29 19:20:38',
                'updated_at' => '2019-09-29 19:20:38',
            ),
        ));
        
        
    }
}