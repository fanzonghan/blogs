<?php

use think\facade\Route;

Route::rule('login', 'LoginController/login');
Route::group(function () {
    Route::rule('index', 'Index/index');
    Route::rule('home', 'Index/home');
    Route::get('logout', 'LoginController/logout');
    Route::get('clear', 'Index/clear');
})->middleware(\app\admin\AdminAuthMiddleware::class);

//文章
Route::group('article', function () {
    //列表
    Route::rule('list', 'ArticleController/list');
    //添加
    Route::rule('add', 'ArticleController/add');
    //编辑
    Route::rule('edit', 'ArticleController/edit');
    //删除
    Route::get('del', 'ArticleController/del');
    //提交收录
    Route::get('gather', 'ArticleController/gather');

})->middleware(\app\admin\AdminAuthMiddleware::class);

//分类
Route::group('category', function () {
    //列表
    Route::rule('list', 'CategoryController/list');
    //编辑
    Route::post('edit', 'CategoryController/edit');
    //添加
    Route::post('add', 'CategoryController/add');
    //删除
    Route::get('del', 'CategoryController/del');

})->middleware(\app\admin\AdminAuthMiddleware::class);

//基本配置
Route::group('setting', function () {
    Route::rule('config', 'SettingController/config');
})->middleware(\app\admin\AdminAuthMiddleware::class);

//标签
Route::group('tag', function () {
    //列表
    Route::rule('list', 'TagController/list');
    //编辑
    Route::rule('edit', 'TagController/edit');
    //添加
    Route::rule('add', 'TagController/add');
    //删除
    Route::get('del', 'TagController/del');
})->middleware(\app\admin\AdminAuthMiddleware::class);

//标签
Route::group('blog_roll', function () {
    //列表
    Route::rule('list', 'BlogrollController/list');
    //编辑
    Route::rule('edit', 'BlogrollController/edit');
    //添加
    Route::rule('add', 'BlogrollController/add');
    //删除
    Route::get('del', 'BlogrollController/del');
})->middleware(\app\admin\AdminAuthMiddleware::class);