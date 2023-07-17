<?php

use think\facade\Route;

Route::group('setting',function () {
    Route::rule('config','SettingController/config');
});