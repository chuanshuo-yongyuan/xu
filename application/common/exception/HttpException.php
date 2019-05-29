<?php
/**
 * FileName: HttpException.php
 * ==============================================
 * Copy right 2016-2017
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: 永 | <chuanshuo_yongyuan@163.com>
 * @date  : 2018/9/1 16:08
 */

namespace app\common\exception;

use Exception;
use think\exception\Handle;

class HttpException extends Handle
{
    public function render(Exception $exception)
    {
        if (version_compare(PHP_VERSION, '5.5.9', '<')) {  //这里判断如果php版本比较低，就默认用系统的，当然你也可以安装版本较低的Whoops
            return parent::render($exception);
        } else {
            $whoops = new \Whoops\Run;

            if (request()->isAjax()) { //如果是ajax请求，就返回json数据
                $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler);

                return $whoops->handleException($exception);
            } else {
                //否则返回html数据
                $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);

                return $whoops->handleException($exception);
            }
        }
    }
}