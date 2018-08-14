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

Route::get('/job/{id}', 'HomeController@job')->name('job.desc');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/m2d7ggtyxkz6stkevurjwujirxqdq7lj/sdmblstuser','sudoController@gate_sdmblst');
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

Route::get('/admin/job-vacancy/{id}/applier', 'admin\seleksiController@applier')->name('admin.job.applier');

Route::get('/admin/candidate/{id}/preview', 'admin\seleksiController@candidate_preview')->name('admin.candidate.preview');

Route::get('/job/{id}/apply', 'ApplyController@apply')->name('job.desc.apply');
Route::post('/job/{id}/apply', 'ApplyController@post_apply')->name('job.desc.post');

Route::get('/profile','userController@profile')->name('my.profile');
Route::get('/application','userController@application')->name('my.application');
Route::get('/profile/edit', 'userController@edit_profile')->name('profile.edit');
Route::post('/profile/edit','userController@update_profile')->name('profile.update');
Route::get('/experience/add','userController@add_history')->name('experience.add.index');
Route::post('/experience/add','userController@new_history')->name('experience.add.post');
Route::post('/experience/edit','userController@edit_history')->name('experience.add.edit');
Route::post('/experience/update','userController@update_history')->name('experience.add.update');
Route::post('/experience/delete','userController@delete_history')->name('experience.add.delete');



// SELEKSI
// Seleksi Section
  Route::get('/admin/seleksi', 'admin\seleksiController@index')->name('seleksi.index');
  Route::get('/admin/seleksi/data', 'admin\seleksiController@member_data')->name('seleksi.data');

  // Tahapan Seleksi
  Route::get('/admin/seleksi/stage', 'admin\seleksiController@stage_index')->name('stage.index');
  Route::post('/admin/seleksi/stage/add', 'admin\seleksiController@stage_post')->name('stage.post');
  Route::post('/admin/seleksi/stage/edit', 'admin\seleksiController@stage_edit')->name('stage.edit');
  Route::post('/admin/seleksi/stage/delete', 'admin\seleksiController@stage_delete')->name('stage.delete');


  // Parameter Seleksi
  Route::get('/admin/seleksi/parameter', 'admin\seleksiController@parameter_index')->name('parameter.index');
  Route::post('/admin/seleksi/parameter/add', 'admin\seleksiController@parameter_post')->name('parameter.post');
  Route::post('/admin/seleksi/parameter/edit', 'admin\seleksiController@parameter_edit')->name('parameter.edit');
  Route::post('/admin/seleksi/parameter/delete', 'admin\seleksiController@parameter_delete')->name('parameter.delete');

  Route::post('/admin/seleksi/score/punch', 'admin\seleksiController@save_score')->name('score.save');
  Route::post('/admin/seleksi/score/lock','admin\seleksiController@lock_score')->name('score.lock');
  Route::post('/admin/seleksi/score/save','admin\seleksiController@save_score_each')->name('score.each.save');

  Route::post('/admin/seleksi/score/lock-all','admin\seleksiController@lock_all')->name('lock.all');
  Route::post('/admin/seleksi/score/unlock-all','admin\seleksiController@unlock_all')->name('unlock.all');

  // Hasil Seleksi
  Route::get('/admin/seleksi/score/result','admin\seleksiController@score_result')->name('seleksi.result');
  Route::post('/admin/seleksi/score/stage-change','admin\seleksiController@change_stage')->name('stage.status.save');

  // Stock
  Route::get('/admin/stock','stockController@index')->name('stock.index');

});
