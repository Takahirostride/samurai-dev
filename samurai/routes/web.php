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


Route::post('/common/policy-put', 'CommonController@updateStatusPolicy');
Route::post('/common/follow', 'CommonController@updateFollow');
Route::post('/common/checklist', 'CommonController@checkListPolicy');

Route::post('policy/scrape', 'PolicyDataController@scrape');
Route::get('policy/scrape1', 'PolicyDataController@scrape1');
Route::get('scrape/69i57j69i60l3j69i59j69i605441j0j7', 'ScrapeController@scrape')->name('scrapformat');
Route::get('scrape/update', 'ScrapeController@update')->name('scrapupdate');

Route::get('/download/assets/pdf/{year}/{mount}/{file}', function ($year='',$mount='',$file='' ) {
    return response()->download('assets/pdf/'.$year.'/'.$mount.'/'.$file);
})->name('download');