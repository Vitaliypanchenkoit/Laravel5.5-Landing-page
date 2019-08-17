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

// Route::get('/', function () {
//     return view('welcome');
// });

/* The group of routes for user part of the application */
Route::group(['middleware'=>'web'],function() {

    Route::match(['get','post'],'/',['uses'=>'IndexController@execute','as'=>'home']);
    Route::get('/page/{alias}',['uses'=>'PageController@execute','as'=>'page']);

    /* For user authentication */
    Route::auth();
});

/*
* The group of routes for creation, updating and deleting pages, portfolios by administrator
*/
// admin/...
Route::group(['prefix'=>'admin','middleware'=>'auth'], function() {

    // admin
    Route::get('/',function() {

    });

    // admin/pages
    Route::group(['prefix'=>'pages'],function() {

        // admin/pages
        Route::get('/',['uses'=>'PagesController@execute','as'=>'pages']);

        // admin/pages/add (For adding pages)
        Route::match(['get','post'],'/add',['uses'=>'PagesAddController@execute','as'=>'pagesAdd']);
        // admin/pages/edit/.. (For editing and deleting pages)
        Route::match(['get','post','delete'],'/edit/{page}',['uses'=>'PagesEditController@execute','as'=>'pagesEdit']);
    });

    // admin/portfolios
    Route::group(['prefix'=>'portfolios'],function() {

        // admin/portfolios
        Route::get('/',['uses'=>'PortfolioController@execute','as'=>'portfolios']);

        // admin/portfolios/add (For adding portfolios)
        Route::match(['get','post'],'/add',['uses'=>'PortfolioAddController@execute','as'=>'portfolioAdd']);
        // admin/portfolios/edit/.. (For editing and deleting portfolios)
        Route::match(['get','post','delete'],'/edit/{page}',['uses'=>'PortfolioEditController@execute','as'=>'portfolioEdit']);

    });

    // admin/services
    Route::group(['prefix'=>'services'],function() {

        // admin/services
        Route::get('/',['uses'=>'ServiceController@execute','as'=>'services']);

        // admin/services/add (For adding services)
        Route::match(['get','post'],'/add',['uses'=>'ServiceAddController@execute','as'=>'serviceAdd']);
        // admin/services/edit/.. (For editing and deleting services)
        Route::match(['get','post','delete'],'/edit/{page}',['uses'=>'ServiceEditController@execute','as'=>'serviceEdit']);

    });
});
