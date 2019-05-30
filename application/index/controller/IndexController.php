<?php

namespace app\index\controller;

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
