<?php

//use Illuminate\Routing\Route;


Route::group(['middleware' => 'web'], function () {
    // route for email verification 
    Route::get('/user/activation/{token}', [
        'uses' => 'Auth\RegisterController@userActivation',
        'as' => 'activation'
    ]);
    // route for page not found 
    Route::get('/pagenotfound', [
        'uses' => 'HomeController@pagenotfound',
        'as' => 'notfound'
    ]);

    // route for password resets
    Route::get('/password/reset/{token}', [
        'uses' => 'Auth\PasswordController@showResetForm',
        'as' => 'password.resetForm'
    ]);

    Route::post('/password/email', [
        'uses' => 'Auth\PasswordController@sendResetLink',
        'as' => 'password.reset'
    ]);

    Route::post('/password/reset', [
        'uses' => 'Auth\PasswordController@reset',
        'as' => 'password.resetPassword'
    ]);

    // route for autocomplete feature
    Route::get('/autocomplete', [
        'uses' => 'HomeController@autocomplete',
        'as' => 'autocomplete'
    ]);

    // post search route
    Route::post('/search', [
        'uses' => 'HomeController@getSearchCourse',
        'as' => 'course.search'
    ]);
    
    Route::get('/', [
        'uses' => 'HomeController@index',
        'as' => 'user.index'
    ]);

    Route::get('/user/login', [
        'uses' => 'Auth\LoginController@getLogin',
        'as' => 'user.login'
    ]);
    
    Route::post('/user/login', [
        'uses' => 'Auth\LoginController@login',
        'as' => 'user.login'
    ]);
    
    Route::get('/user/register', [
        'uses' => 'Auth\RegisterController@getRegister',
        'as' => 'user.register'
    ]);
    
    Route::post('/user/register', [
        'uses' => 'Auth\RegisterController@register',
        'as' => 'user.register'
    ]);
    
    Route::get('/courses', [
        'uses' => 'HomeController@getCourses',
        'as' => 'user.course'
    ]);
    
    Route::get('/classroom', [
        'uses' => 'HomeController@getClassRoom',
        'as' => 'user.classroom'
    ]);

    Route::get('/cart', [
        'uses' => 'HomeController@getCart',
        'as' => 'user.cart'
    ]);

    Route::get('/user/logout', [
        'uses' => 'HomeController@getLogout',
        'as' => 'user.logout'
    ]);

    Route::get('/course/{id}', [
        'uses' => 'HomeController@getCourseDetails',
        'as' => 'getCourse'
    ]);

    // add course to the cart 
    Route::get('/add/{id}', [
        'uses' => 'HomeController@getAddToCart',
        'as' => 'addCourse'
    ]);

    Route::get('/remove/{id}', [
        'uses' => 'HomeController@getRemoveCourse',
        'as' => 'getRemoveCourse'
    ]);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/checkout', [
            'uses' => 'HomeController@getCheckout',
            'as' => 'getCheckout'
        ]);
    });

    //Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');

});


Route::auth();



//Route::get('/home', 'HomeController@index');