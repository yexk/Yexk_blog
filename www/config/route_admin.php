<?php
use think\Route;
// 后台路由 
Route::rule('yexk','admin/index/index');
Route::alias('yexk','admin/index');

Route::rule('cate','admin/Category/index');
Route::alias('cate','admin/Category');

Route::rule('article','admin/Article/index');
Route::alias('article','admin/Article');

Route::rule('login','admin/Login/index');
Route::alias('login','admin/Login');

// Route::rule('cate/[:name]','admin/Category/:name');
