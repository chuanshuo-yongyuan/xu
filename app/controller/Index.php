<?php

namespace app\controller;

use app\BaseController;
use \Curl\Curl;
use Overtrue\Pinyin\Pinyin;

class Index extends BaseController
{
    public function index()
    {
//        $step = 34980;//提交步数

        $randStep = mt_rand(34443, 35042);
        $step = input('step', $randStep);

        $curl = new Curl();

        $salt = '8061FD';//salt


        $account = 'coffin';//绑定微信的卓易账号
        $timestamp = time();
        $sign = md5($account . $salt . $timestamp);

        $host = "http://weixin.droi.com/health/phone/index.php/SendWechat/getWxOpenid";
        $curl->post($host, [
            'accountId' => $account,
            'timeStamp' => $timestamp,
            'sign'      => $sign,
        ]);

        if ($curl->error) {
            die('Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n");
        } else {
            $rep = json_decode($curl->response, true);
            if ($rep['code'] !== 0) {
                die('getWxOpenid:' . $rep['messsage'] . "\n");
            }
            $openid = $rep['openid'];
            echo "WeChatOpenId: {$openid}\n";
        }
        echo "</br>";
        echo "</br>";
        $timestamp = time();
        $sign = md5($account . $salt . $step . $salt . $timestamp . $salt . $openid);
        $host = "http://weixin.droi.com/health/phone/index.php/SendWechat/stepSubmit";
        $curl->post($host, [
            'accountId' => $account,
            'jibuNuber' => $step,
            'timeStamp' => $timestamp,
            'sign'      => $sign,
        ]);

        if ($curl->error) {
            die('stepSubmit: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n");
        } else {
            $rep = json_decode($curl->response, true);
            echo "stepSubmit: " . $rep['messsage'];
        }

        $curl->close();
    }

    public function hello()
    {
        $pinyin = new Pinyin(); // 默认
        $str = '123312 作为一个程序员，我们的目标是什么！没有 bug ! 不不不，是不断追求自我价值的实现，今天推荐一个听音乐的项目，没错是个音乐播放器：ieaseMusic。它是基于网易云音乐 API 开发的第三方客户端，支持 Linux、Mac OS 系统，已经是一款成熟的 JS 桌面应用产品，颜值很高，音乐资源丰富。最重要的是你可以拉源码学习一下，重构成一个只属于自己的音乐播放器，来试试吧！';

        $result = $pinyin->convert($str, PINYIN_TONE | PINYIN_KEEP_ENGLISH | PINYIN_KEEP_NUMBER | PINYIN_KEEP_PUNCTUATION);

        dd($str, implode($result, ' '));
    }
}
