<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

return [
    // 指令名 =》完整的类名
    'create:controller'  => "app\\common\\command\\create\\Controller",
    'create:model'       => "app\\common\\command\\create\\Model",
    'create:validate'    => "app\\common\\command\\create\\Validate",
    'create:service'     => "app\\common\\command\\create\\Service",
    'create:transformer' => "app\\common\\command\\create\\Transformer",
    'create:event'       => "app\\common\\command\\create\\Event",
];