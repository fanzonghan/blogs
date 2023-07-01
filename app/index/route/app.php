<?php
use think\facade\Route;
Route::get('search','Index/search');


Route::rule('cate/:id','Category/index');


Route::get('article/:id','Article/index');