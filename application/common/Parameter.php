<?php
/**
 * FileName: Check.php
 * ==============================================
 * Copy right 2016-2018
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: 永 | <chuanshuo_yongyuan@163.com>
 * @date  : 2018/11/19 11:35
 */

namespace app\common;


trait Parameter
{
//    use Send;

    /**
     * 判断请求是否为 post 请求,如果不是,返回404
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    final protected function isPost()
    {
        if ( ! request()->isPost()) {
            $this->notFound();
        }
    }

    /**
     * 判断传参是否有 ID 参数
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    final protected function isId()
    {
        $id = input('id');
        if ( ! $id) {
            $this->error('请选择需要操作的数据');
        }
    }

    /**
     * 是否是 POST 操作  并且是否传递了 ID 参数
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    final protected function isPostAndId()
    {
        $this->isPost();
        $this->isId();
    }
}