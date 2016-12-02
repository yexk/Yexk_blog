<?php
use think\Route;
// 后台路由 
Route::alias('yexk','admin/index');
Route::alias('cate','admin/Category');
Route::alias('login','admin/Login');


// Route::rule('yexk/[:name]','admin/index/index');
// Route::rule('cate/[:name]','admin/Category/:name');
