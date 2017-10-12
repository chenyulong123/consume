<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
//
//];
use think\Route;
Route::get('/','index/User/index');


Route::get('/index/product_info', 'index/User/product_info');
Route::post('/index/created_ticket', 'index/User/created_ticket');
Route::get('/index/delete_ticket/:id', 'index/User/delete_ticket');

Route::get('/index/today_consume', 'index/User/today_consume');
Route::get('/index/count_today_consume', 'index/User/count_today_consume');
Route::get('/index/month_consume', 'index/User/month_consume');
Route::get('/index/count_month_consume', 'index/User/count_month_consume');

