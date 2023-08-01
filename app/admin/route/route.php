<?php

use think\facade\Route;

Route::get('logout','LoginController/logout');
Route::rule('login','LoginController/login');
