<?php
use think\facade\Route;

//搜索页
Route::get('search','Index/search');

//分类页
Route::rule('cate','Category/index');

Route::rule('article','Article/info');

Route::rule('s','Test/test');