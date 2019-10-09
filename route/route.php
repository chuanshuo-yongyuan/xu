<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
Route::miss(function () {
    return json([
        'message' => '页面不存在',
        'code'    => 404,
        'data'    => [],
    ]);
});
Route::get('/', 'index/Index/index');
Route::get('/wechat-step', 'index/Index/wechatStep');

Route::group('api', function () {
    Route::get('/', 'index/Index/index');
    Route::get('lists', 'index/Index/lists')->allowCrossDomain();
    Route::post('add', 'index/Index/add')->allowCrossDomain();
})->allowCrossDomain();


return [

];
