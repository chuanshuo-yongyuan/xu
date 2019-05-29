<?php
/**
 * FileName: Send.php
 * ==============================================
 * Copy right 2016-2018
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: 永 | <chuanshuo_yongyuan@163.com>
 * @date  : 2018/11/19 10:42
 */

namespace app\common;


use think\exception\HttpResponseException;

/**
 * Trait Send
 * @package app\common
 */
trait Send
{
    /**
     * @var int
     */
    protected $code = 200;
    /**
     * @var string
     */
    protected $message = 'OK';

    /**
     * @return int
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    protected function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     *
     * @return $this
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    protected function setCode(int $code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    protected function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return $this
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    protected function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    protected function empty()
    {
        $this->setCode(404)->setMessage('数据不存在')->response();
    }

    /**
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    protected function notFound()
    {
        $this->setCode(404)->setMessage('页面不存在')->response();
    }

    /**
     * @param string $message
     * @param int    $code
     *
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    protected function error($message = '未知错误,稍后再试~!', $code = 0)
    {
        $this->setCode($code)->setMessage($message)->response();
    }

    /**
     * @param string $message
     * @param int    $code
     *
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    protected function success($message = '操作成功', $code = 200)
    {
        $this->setCode($code)->setMessage($message)->response();
    }

    /**
     * @param array $data
     *
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    protected function response($data = [])
    {
        $return = [
            'code'    => $this->getCode(),
            'message' => $this->getMessage(),
            'data'    => $data,
        ];
        $return = json($return);
        $this->returnResponse($return);
    }

    /**
     * @param $response
     *
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    protected function returnResponse($response)
    {
        throw new HttpResponseException($response);
    }
}