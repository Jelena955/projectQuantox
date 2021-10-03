<?php
/**
 * This file contains all the routes for the project
 */

use Jelena\Models\DB;
use Jelena\Controllers\ApiController;
use Jelena\Controllers\DefaultController;
use Jelena\Middlewares\ApiVerification;
use Jelena\Router;
use Jelena\Controllers\NewsController;
use Jelena\Controllers\CategoryController;
use Jelena\Controllers\SearchController;
use Jelena\Controllers\SubscribesController;
use Jelena\Controllers\LoginController;
use Jelena\Controllers\LogOutController;

Router::csrfVerifier(new Jelena\Middlewares\CsrfVerifier());

Router::setDefaultNamespace('\Jelena\Controllers');

Router::group(['exceptionHandler' => Jelena\Handlers\CustomExceptionHandler::class], function () {

	Router::get('/',  [NewsController::class, 'writeNewss'])->setName('news');
   // Router::get('/base',  [DB::class, 'select'])->setName('base');
    Router::get('/news',  [NewsController::class, 'writeNewss'])->setName('news');
    Router::get('/category',[CategoryController::class, 'store'])->setName('category');
    Router::get('/search',[SearchController::class, 'search'])->setName('category');
    Router::post('/insertsubscribes',[SubscribesController::class, 'insertSubscribes'])->setName('insert');
    Router::get('/login',[LoginController::class, 'forma'])->setName('forma');
    Router::post('/sendlogin',[LoginController::class, 'login'])->setName('forma');
    Router::get('/sendlogin',[LoginController::class, 'login'])->setName('forma');
    Router::get('/logout',[LogOutController::class, 'unsetMail'])->setName('unsetmail');
    Router::get('/new',[NewsController::class, 'writeNeww'])->setName('new');
    Router::post('/subscribenew',[SubscribesController::class, 'insertSubscribes'])->setName('insert');
    Router::get('/insertnews',[NewsController::class, 'insertNews'])->setName('insert');
    Router::get('/update',[NewsController::class, 'updateNews'])->setName('update');





	Router::get('/contact', 'DefaultController@contact')->setName('contact');

	Router::basic('/companies/{id?}', 'DefaultController@companies')->setName('companies');

    // API

	Router::group(['prefix' => '/api', 'middleware' => Jelena\Middlewares\ApiVerification::class], function () {
		Router::resource('/demo', 'ApiController');
	});

    // CALLBACK EXAMPLES

    Router::get('/foo', function() {
        return 'foo';
    });

    Router::get('/foo-bar', function() {
        return 'foo-bar';
    });

    Router::get('/api/show/{id}', [ApiController::class, 'show'], [
        'middleware' => ApiVerification::class,
    ]);
    Router::get('/api/index', [ApiController::class, 'index']);

});