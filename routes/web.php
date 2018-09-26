<?php

    $router->group(['prefix'=>'api/v1'], function() use($router){
        $router->get('/', function () use ($router) { return $router->app->version(); });

        /** produtos **/
        $router->get('/products', 'ProductController@index');
        $router->post('/product/add', 'ProductController@create');
        $router->get('/product/{id}', 'ProductController@show');
        $router->put('/product/{id}', 'ProductController@update');
        $router->delete('/product/{id}', 'ProductController@destroy');

        /** categorias  */
        $router->get('/categories', 'CategoryController@index');
        $router->post('/category/add', 'CategoryController@create');
    });
