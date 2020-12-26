<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/post', function() {
//     return view('post_view');
// });

Route::get('/titletest', function() {
    return view('maketitletest');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/about', 'HomeController@about')->name('about');

Route::get('/contact', 'HomeController@contact')->name('contact');

Route::get('/unauthorized', 'HomeController@unauthorized')->name('unauthorized');

Route::get('/admin', 'HomeController@admin')->name('admin');

Route::resource('sidebars', 'SidebarController');

Route::resource('topics', 'TopicController');

Route::resource('subtopics', 'SubtopicController');

Route::resource('articles', 'ArticleController');

// Route::put('articles/{slug}/statusupdate', 'ArticleController@statusupdate')->name('articles.statusupdate');

Route::get('article/{slug}', 'ArticleController@read')->name('articles.read');

Route::get('{slug}/articles+videos', 'ArticleController@topic_filter')->name('topic.articles');

Route::get('latest_articles', 'ArticleController@latest_filter')->name('articles.latest');

Route::get('popular_articles', 'ArticleController@popular_filter')->name('articles.popular');

//Profiles

Route::get('author/{name}', 'ProfileController@author')->name('profiles.author');

Route::get('user/{username}', 'ProfileController@user')->name('profiles.user');

Route::put('user/{id}', 'ProfileController@user_update')->name('profiles.user_update');

Route::resource('profiles', 'ProfileController');

Route::resource('users', 'UserController');

Route::get('coming_soon', 'ErrorController@cs')->name('errors.cs');

Route::resource('readlists', 'ReadlistController');

Route::resource('books', 'BookController');

Route::resource('socialmedias', 'SocialmediaController');

Route::post('/', 'HomeController@mail')->name('contactmail');

// Route::get('blog/{slug}', 'BlogController@getSingle')->name('blog.single');

// Route::post('/uploader/upload', '\Optimus\FineuploaderServer\Controller\FineuploaderController@upload');
// Route::delete('/uploader/delete/{uuid}', '\Optimus\FineuploaderServer\Controller\FineuploaderController@delete');
// Route::get('/uploader/session', '\Optimus\FineuploaderServer\Controller\FineuploaderController@session');
