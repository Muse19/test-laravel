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

Route::get('/', 'HomeController@index');

Route::get('relatorio', 'ReportController@relatorio');
Route::get('pizza', 'ReportController@pizza');
Route::get('grafico', 'ReportController@grafico');
   
