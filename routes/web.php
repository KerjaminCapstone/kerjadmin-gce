<?php

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

// Homepage (non-login)
Route::get('/', function () {
    return redirect('/login');
});

// Route auth
Auth::routes(['register' => false]);

// Route untuk admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:admin-users')->group(function() {
    Route::resource('/freelancers', 'FreelancerController');
    Route::resource('/complaints', 'ComplaintManagementController');
});

// Route umum
Route::resource('/complaints', 'ComplaintView');

// Route Logout
Route::get('/logout', function(){
    // logout user
    Auth::logout();
    // redirect to homepage
    return redirect('/');
});
