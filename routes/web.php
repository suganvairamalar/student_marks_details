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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/student_details','StudentDetailController@index')->name('student_detail.index');
Route::get('/student_detail_add_data','StudentDetailController@insert')->name('student_detail.insert');
Route::get('/student_detail_edit_data/{id}','StudentDetailController@edit')->name('student_detail.edit');
Route::post('/student_detail_update_data','StudentDetailController@update')->name('student_detail.update');
Route::get('/student_detail_delete_data/{id}/','StudentDetailController@delete')->name('student_detail.delete');

Route::get("/student_marks","StudentMarkController@index")->name('student_mark.index');
Route::get('/student_name_fetch','StudentMarkController@student_name_fetch')->name('student_mark.student_name_fetch');
Route::post('/student_mark_add_data','StudentMarkController@insert')->name('student_mark.insert');
Route::get('/student_mark_edit_data/{id}','StudentMarkController@edit')->name('student_mark.edit');
Route::post('/student_mark_update_data','StudentMarkController@update')->name('student_mark.update');
Route::get('/student_mark_delete_data/{id}/','StudentMarkController@delete')->name('student_mark.delete');

