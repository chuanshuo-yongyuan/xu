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

Route::get('admin', function () {
    return view('admin');
});
Route::get('business', function () {
    return view('business');
});

Route::miss(function () {
    return json([
        'message' => '页面不存在',
        'code'    => 404,
        'data'    => [],
    ]);
});

return [

];
