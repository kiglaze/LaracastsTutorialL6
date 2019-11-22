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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/chocolate', function () {
//    return view('chocolate');
//});

Route::get('/chocolate', 'ChocolateController@show');

Route::get('/nameinfo', function () {
    $name = request('name');
    return view('nameinfo', [
        'name' => $name
    ]);
});

Route::get('/posts/{post}', 'PostsController@show');

Route::get('contact', function () {
    return view('contact');
});

Route::get('about', function () {
    $articles = App\Article::latest('created_at')->take(2)->get();
    return view('about', [
        'articles' => $articles
    ]);
});


Route::get('articles', 'ArticlesController@index');
Route::post('articles', 'ArticlesController@store');
Route::get('articles/create', 'ArticlesController@create');
Route::get('articles/{article}', 'ArticlesController@show');
Route::post('articles/{article}', 'ArticlesController@update');

// GET, POST, PUT, DELETE (use these request verbs)
// GET /articles
// GET /articles/:id
// GET /articles/:id/edit
// POST //articles
// PUT /articles/:id
// DELETE /articles/:id
