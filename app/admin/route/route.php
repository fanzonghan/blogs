<?php

use think\facade\Route;

Route::group('login',function () {
    Route::rule('index','LoginController/index');
    Route::post('login','LoginController/login');
});