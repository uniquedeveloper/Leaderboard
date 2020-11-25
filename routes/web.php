<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

Route::get('/employees', 'EmployeeController@index');
Route::post('/employees/edit/{employee}', 'EmployeeController@edit');
Route::post('/employees/new/{employee?}', 'EmployeeController@add');
Route::delete('/employees/delete/{employee?}', 'EmployeeController@delete' );


// Route::post('/editEmployee', 'EmployeeController@create');
