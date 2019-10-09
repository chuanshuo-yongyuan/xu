<?php

namespace app\index\controller;

use \Curl\Curl;
use app\common\event\IndexEvent;
use app\common\model\StepsModel;
use app\common\transformer\StepsTransformer;
use app\common\validate\IndexValidate;

class IndexController extends Controller
{
    private $stepsTransformer;

    public function __construct(StepsTransformer $stepsTransformer)
    {
        parent::__construct();
        $this->stepsTransformer = $stepsTransformer;
    }

    public function index()
    {
    }

    public function lists()
    {
        $time = input('time');
        $time = strtotime($time ?: date('Y-m-d', time()));
        $lists = StepsModel::where('create_time', '>=', $time)->where('create_time', '<=', $time + 24 * 60 * 60)->order('create_time', 'asc')->select();
        $res = $this->stepsTransformer->transformCollection($lists->all());
        $this->response($res);
    }

    public function info()
    {
    }

    public function wechatStep()
    {
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


    public function add()
    {
        $step = input('step', 0, 'intval');
        $message = input('message');
        if ( ! $step || $step < 1) {
            $this->error('请输入正确的步数');
        }
        $res = StepsModel::create([
            'step'    => $step,
            'message' => $message,
        ]);
        $this->checkSuccessOrError($res);
    }

    public function edit()
    {
    }

    public function status()
    {
    }
}
