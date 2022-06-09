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
    //return view('welcome');
    return redirect('/dashboard');
});

Route::get('/changepassword', function() {
    $user = App\Models\User::where('email', 'thanhson@elte.hu')->first();
    $user->password = Hash::make('123456');
    $user->save();
  
    echo 'Password changed successfully.';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
