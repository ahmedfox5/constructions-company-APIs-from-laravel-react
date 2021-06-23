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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'dashboard'] ,function(){

    Route::get('/' ,'dashboardController@index')->name('dashboard');

//    dashboard / messages
    Route::get('/messages/' ,'dashboardController@messages') -> name('messages');
    Route::get('/messages/message/{id}' ,'dashboardController@message') -> name('message');
    Route::get('/delete-message/{id}' ,'dashboardController@deleteMessageGet')->name('message.delete');
    Route::post('/delete-message' ,'dashboardController@deleteMessage')->name('ajax.message.delete');

//    pages content
    Route::group(['prefix' => 'pages'] ,function(){
        Route::get('/' ,'dPagesController@index')->name('pages.content');
        Route::get('/add-about-section' ,'dPagesController@addAboutSection')->name('about.add');
        Route::post('/add-about-section-submit' ,'dPagesController@addAboutSectionStore')->name('about.add.store');
        Route::post('/delete-about-section-submit' ,'dPagesController@deleteAboutSectionStore')->name('about.section.delete');
        Route::post('/pages-update' ,'dPagesController@pagesUpdate')->name('pages.update');
        Route::get('/about/update/{id}' ,'dPagesController@aboutUpdate')->name('about.update');
        Route::post('/about/update-about/{id}' ,'dPagesController@aboutUpdateStore')->name('about.update.store');
    });

//    projects
    Route::group(['prefix' => 'projects'] ,function (){
       Route::get ('/' ,'projectsController@index') -> name('projects');
       Route::get ('/project/{id}' ,'projectsController@project')->name('project');
       Route::post ('/project/delete}' ,'projectsController@delete')->name('project.delete');
       Route::post('/project/header-save' ,'projectsController@headerSave')->name('project.header.save');
       Route::post('/project/imgs-save' ,'projectsController@imgsSave')->name('project.imgs.save');
       Route::post('/project/imgs-delete' ,'projectsController@imgsDelete')->name('project.imgs.delete');
       Route::post('/project/section-delete' ,'projectsController@sectionDelete')->name('project.section.delete');
       Route::post('/project/sore-section/{id}' ,'projectsController@storeProjectSection')->name('project.section.store');
       Route::get ('/new-section/{id}' ,'projectsController@newSection')->name('project.section.add');
       Route::get ('/project/section-update/{id}' ,'projectsController@sectionUpdate')->name('project.section.update');
       Route::post('/project/section-edit/{id}' ,'projectsController@sectionEdit')->name('project.section.edit');
       Route::get ('/add-project' ,'projectsController@newProject')->name('new.project');
       Route::post('/store-project' ,'projectsController@storeProject')->name('store.project');
       Route::post('/edit-project-employees' ,'projectsController@editProjectEmployees')->name('edit.project.employees');
    });


//    employees
    Route::group(['prefix' => 'employees'] ,function (){
       Route::get('/' ,'employeesController@index')->name('employees');
       Route::post('/delete-employee', 'employeesController@destroy')->name('delete.employee');
       Route::get('/edit-employee/{id}' ,'employeesController@edit')->name('edit.employee');
       Route::post('/update-employee/{id}' ,'employeesController@update')->name('update.employee');
       Route::get('/create-employee' ,'employeesController@create')->name('create.employee');
       Route::post('/store-employee' ,'employeesController@store')->name('store.employee');
    });





});//// end of dashboard group

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
