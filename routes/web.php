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
    return view('layouts.application');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/registrations', '');


Route::group([
     'middleware' => 'auth'
], function()
{

Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
Route::get('/admin/division', 'AdminController@division')->name('admin.division.index');
Route::get('/admin/job-vacancy', 'AdminController@jobvacancy')->name('admin.jobvacancy.index');
Route::get('/admin/job-vacancy/add', 'AdminController@jobvacancy_add')->name('admin.jobvacancy.add');
Route::post('/admin/job-vacancy/create', 'AdminController@jobvacancy_create')->name('admin.jobvacancy.create');
Route::post('/admin/job-vacancy/{id}/edit', 'AdminController@jobvacancy_edit')->name('admin.jobvacancy.edit');
Route::post('/admin/job-vacancy/{id}/save', 'AdminController@jobvacancy_edit_post')->name('admin.jobvacancy.postedit');
Route::post('/admin/job-vacancy/{id}/delete', 'AdminController@jobvacancy_delete')->name('admin.jobvacancy.delete');


});
