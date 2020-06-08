<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['jwt.auth'], 'prefix' => 'v1'], function () {

    Route::get('/projects/user', 'ProjectsController@getCurrentUserProjects');
    Route::post('/projects', 'ProjectsController@createProject');
    Route::delete('/projects/{id}', 'ProjectsController@deleteProject');
    Route::post('/course', 'CourseController@store');
    Route::get('/course', 'CourseController@index');
    Route::post('/unit', 'UnitController@store');
    Route::get('/units/{id}', 'UnitController@getUnitsByCourse');
    Route::post('/slide', 'SlideController@store');
    Route::post('/upload', 'CourseController@upload');
});

Route::group(['middleware' => [], 'prefix' => 'auth'], function () {

    Route::get('/projects', 'ProjectsController@getAll');
//    Route::get('/projects/{id}', 'ProjectsController@getProjectById');
    Route::get('/projects/{project}', 'ProjectsController@getProjectBySlug');

    // Auth
    Route::post('/login', 'TokensController@login');
    Route::post('/refresh', 'TokensController@refreshToken');
    Route::get('/logout', 'TokensController@expireToken');
});



