<?php

Route::group(['middleware' => 'web'], function () {
    // comment route
    Route::post('/user/comment', [
        'uses' => 'HomeController@postComment',
        'as' => 'user.comment'
    ]);

    Route::post('/user/comment/fetch', [
        'uses' => 'HomeController@fetchComment',
        'as' => 'user.fetchComment'
    ]);

    // route for email verification 
    Route::get('/user/activation/{token}', [
        'uses' => 'Auth\RegisterController@userActivation',
        'as' => 'activation'
    ]);

    Route::get('/user/active', [
        'uses' => 'Auth\RegisterController@getResendForm',
        'as' => 'getActive'
    ]);

    Route::post('/user/active', [
        'uses' => 'Auth\RegisterController@postResendForm',
        'as' => 'postActive'
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
        'as' => 'password.reset',
        'middleware' => 'guest'
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
    Route::post('/user/search', [
        'uses' => 'HomeController@getSearchCourse',
        'as' => 'course.search'
    ]);
    
    Route::get('/', [
        'uses' => 'HomeController@index',
        'as' => 'user.index'
    ]);

    Route::get('/user/contact', [
        'uses' => 'HomeController@contact',
        'as' => 'user.contact'
    ]);

    Route::post('/user/contact', [
        'uses' => 'HomeController@postContact',
        'as' => 'user.contact'
    ]);

    Route::get('/user/review', [
        'uses' => 'HomeController@getReview',
        'as' => 'user.review'
    ]);

    Route::post('/user/review', [
        'uses' => 'HomeController@postReview',
        'as' => 'user.review'
    ]);

    Route::get('/user/services', [
        'uses' => 'HomeController@services',
        'as' => 'user.services'
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
        'as' => 'user.course',
        'middleware' => 'auth'
    ]);
    
    Route::get('/classroom/{id}', [
        'uses' => 'HomeController@getClassRoom',
        'as' => 'user.classroom',
        'middleware' => 'auth'
    ]);

    Route::get('/topic/{lecture_id}/{id}', [
        'uses' => 'HomeController@getTopic',
        'as' => 'user.topic',
        'middlware' => 'auth'
    ]);

    Route::get('/cart', [
        'uses' => 'HomeController@getCart',
        'as' => 'user.cart'
    ]);

    Route::get('/user/logout', [
        'uses' => 'HomeController@getLogout',
        'as' => 'user.logout',
        'middleware' => 'auth'
    ]);

    Route::get('/course/{sub_id}/{id}', [
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
        

        Route::post('/f&bm&jgf&hjfhh&hfhghtzfgturfeuwh&vfdbssguiuewfhdje&rbnvihrslcnuiwbuvrcbicrkuhvtrikujesbxxusx', [
            'uses' => 'HomeController@getCheckout',
            'as' => 'getCheckout'
        ]);
    });

    //////////////////Admin User Route//////////////////////
    Route::get('/user/admin', [
        'uses' => 'Auth\AdminLoginController@showLoginForm',
        'as' => 'admin.login'
    ]);

    Route::post('/user/admin', [
        'uses' => 'Auth\AdminLoginController@login',
        'as' => 'admin.login'
    ]);

    Route::get('/admin/dashboard', [
        'uses' => 'AdminController@showLoginForm',
        'as' => 'admin.login'
    ]);

    Route::get('/admin/dashboard', [
        'uses' => 'AdminController@getDashboard',
        'as' => 'admin.dashboard'
    ]);

    Route::get('/admin/logout', [
        'uses' => 'AdminController@logout',
        'as' => 'admin.logout'
    ]);

    Route::get('/admin/lecture', [
        'uses' => 'AdminController@getLecture',
        'as' => 'admin.lecture'
    ]);
    
    Route::post('/admin/lecture', [
        'uses' => 'AdminController@postAddLecture',
        'as' => 'admin.lecture'
    ]);

    Route::get('/admin/reply', [
        'uses' => 'AdminController@getComment',
        'as' => 'admin.comment'
    ]);

    Route::post('/admin/reply', [
        'uses' => 'AdminController@postReply',
        'as' => 'admin.comment'
    ]);

    Route::get('/admin/course', [
        'uses' => 'AdminController@getCourse',
        'as' => 'admin.addCourse'
    ]);

    Route::post('/admin/course', [
        'uses' => 'AdminController@postCourse',
        'as' => 'admin.addCourse'
    ]);

    Route::post('/admin/subject', [
        'uses' => 'AdminController@postAddSubject',
        'as' => 'admin.addSubject'
    ]);

    // dynamic drop down
    Route::get('/admin/dynamic', [
        'uses' => 'AdminController@fetch',
        'as' => 'admin.dynamic'
    ]);

    Route::get('/admin/dynamicTopic', [
        'uses' => 'AdminController@fetchTopics',
        'as' => 'admin.dynamicTopic'
    ]);

    
    Route::post('/admin/updateCourse', [
        'uses' => 'AdminController@postUpdateCourse',
        'as' => 'admin.updateCourse'
    ]);

    Route::get('/admin/editCourse/{id}', [
        'uses' => 'AdminController@getEditCourse',
        'as' => 'admin.editCourse'
    ]);

    Route::get('/admin/deleteCourse/{id}', [
        'uses' => 'AdminController@getDeleteCourse',
        'as' => 'admin.deleteCourse'
    ]);

    Route::get('/admin/deleteLecture/{id}', [
        'uses' => 'AdminController@getDeleteLecture',
        'as' => 'admin.deleteLecture'
    ]);

    Route::get('/admin/editLecture/{id}', [
        'uses' => 'AdminController@getEditLecture',
        'as' => 'admin.editLecture'
    ]);

    Route::post('/admin/updateLecture', [
        'uses' => 'AdminController@postUpdateLecture',
        'as' => 'admin.updateLecture'
    ]);

    Route::get('/admin/deleteSubject/{id}', [
        'uses' => 'AdminController@getDeleteSubject',
        'as' => 'admin.deleteSubject'
    ]);

});


Route::auth();

