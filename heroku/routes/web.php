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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Resultats de recherche
Route::get('/', 'PostController@index')->name('root');
Route::post('/search-results', 'PostController@search')->name('search');

// Formulaire de creation de posts
Route::get('/create','PostController@create')->name('createPost')->middleware('auth');
Route::post('/create', 
    [ 'as'=>'insertDB', 'uses'=>'PostController@store'])->middleware('auth');

// Delete a post
Route::get('/delete/{id}',
	[ 'as'=>'delete','uses'=>'PostController@destroy'])->middleware('auth');

// Formulaire d'édition de posts
Route::get('/edit/{id}',
	[ 'as'=>'edit','uses'=>'PostController@edit'])->middleware('auth');
Route::post('/edit/{id}', 
    [ 'as'=>'update','uses'=>'PostController@update'])->middleware('auth');
    
// Afficher l'article par ID
Route::get('/annonce/{id}', 'PostController@show')
->name('annonces')
->middleware('auth');