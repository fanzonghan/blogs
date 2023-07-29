<?php

use think\facade\Route;

Route::group('article',function () {
    Route::rule('list','ArticleController/list');
    Route::rule('add','ArticleController/add');
    Route::rule('edit','ArticleController/edit');
    Route::get('del','ArticleController/del');

    Route::get('gather','ArticleController/gather');//收录
});