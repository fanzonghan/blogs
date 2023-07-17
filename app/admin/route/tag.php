<?php
use think\facade\Route;

Route::group('tag',function () {
    Route::rule('list','TagController/lst');
    Route::rule('edit','TagController/edit');
    Route::get('del','TagController/del');
});
