<?php

use think\facade\Route;

Route::group(function () {
    //搜索页
    Route::get('search', 'Index/search');
    //分类页
    Route::rule('cate', 'Category/index');

    Route::get('article/:id', 'Article/info');

    Route::get('article', 'Article/index');

    Route::rule('s', 'Test/test');
})->middleware(\app\index\middleware\LogMiddleware::class);