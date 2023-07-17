<?php

use think\facade\Route;

Route::group('category',function () {
    Route::rule('list','CategoryController/list');
    Route::post('edit','CategoryController/edit');
    Route::post('add','CategoryController/add');
    Route::get('del','CategoryController/del');

});