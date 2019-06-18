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
  return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@ShowDashboard');

Route::get('/member', 'MemberController@ShowDashboard');

// ADMIN
Route::get('sup/showinput', 'AdminController@ShowSupInput');
Route::get('sup/showlist', 'AdminController@ShowSupList');
Route::get('sup/showdelete/{id}', 'AdminController@ShowSupDelete');
Route::get('sup/showedit/{id}', 'AdminController@ShowSupEdit');

Route::get('bar/showinput', 'AdminController@ShowBarInput');
Route::get('bar/showlist', 'AdminController@ShowBarList');
Route::get('bar/showdelete/{id}', 'AdminController@ShowBarDelete');
Route::get('bar/showedit/{id}', 'AdminController@ShowBarEdit');
Route::get('bar/showdetailsup/{id}', 'AdminController@ShowBarDetail');

Route::get('pemb/showinput', 'AdminController@ShowPembInput');
Route::get('pemb/showinput/beli/{id}', 'AdminController@ShowPembInputBeli');
Route::get('pemb/showinput/beli/{id}/{msg}', 'AdminController@ShowPembInputBeliMsg');
Route::get('pemb/showlist', 'AdminController@ShowPembList');
Route::get('pemb/showdelete/{id}', 'AdminController@ShowPembDelete');
Route::get('pemb/showedit/{id}', 'AdminController@ShowPembEdit');
Route::get('pemb/showdetailbar/{id}', 'AdminController@ShowPembDetail');

Route::post('sup/prosesinput', 'AdminController@ProsesSupInput');
Route::post('sup/prosesedit', 'AdminController@ProsesSupEdit');
Route::get('sup/prosesdelete/{id}', 'AdminController@ProsesSupDelete');

Route::post('bar/prosesinput', 'AdminController@ProsesBarInput');
Route::post('bar/prosesedit', 'AdminController@ProsesBarEdit');
Route::get('bar/prosesdelete/{id}', 'AdminController@ProsesBarDelete');

Route::post('pemb/prosesinput', 'AdminController@ProsesPembInput');
Route::post('pemb/prosesedit', 'AdminController@ProsesPembEdit');
Route::get('pemb/prosesdelete/{id}', 'AdminController@ProsesPembDelete');

Route::get('memb/showinput', 'AdminController@ShowMembInput');
Route::get('memb/showlist', 'AdminController@ShowMembList');
Route::get('memb/showlist/{msg}', 'AdminController@ShowMembListMsg');
Route::get('memb/showdelete/{id}', 'AdminController@ShowMembDel');
Route::get('memb/prosesdelete/{id}', 'AdminController@ProsesMembDel');
Route::get('memb/showedit/{id}', 'AdminController@ShowMembEdit');
// END ADMIN