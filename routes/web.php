<?php

use App\User;
use Illuminate\Support\Facades\Route;

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

Auth::routes([
    // 'register' =>  User::count() > 0 ? false : true, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);
Route::get('/',function ()
{
    return redirect(route('login'));
});


Route::middleware(['auth'])->group(function ()
{
    Route::get('profile', 'AuthenticationController@index')->name('profile.index');
    Route::put('profile/update', 'AuthenticationController@update')->name('profile.update');
    Route::put('profile/password', 'AuthenticationController@password')->name('profile.password');
    Route::resource('home', 'HomeController');
    Route::get('order/pending', 'SellingController@income')->name('selling.income');
    Route::resource('buying', 'BuyingController');
    Route::resource('product', 'ProductController');
    Route::post('product/send/{product}', 'ProductController@send')->name('product.send');
    Route::delete('product/delete/send/{product}', 'ProductController@delete')->name('product.delete');
    Route::resource('taxi', 'TaxiController');
    Route::resource('city', 'CityController');
    Route::resource('outcome', 'OutcomeController');
    Route::resource('selling', 'SellingController');
    Route::resource('report', 'ReportController');
    Route::resource('note', 'NoteController');

});
