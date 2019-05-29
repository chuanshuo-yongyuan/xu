<?php
/**
 * FileName: Common.php
 * ==============================================
 * Copy right 2016-2018
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: 永 | <chuanshuo_yongyuan@163.com>
 * @date  : 2019-01-10 09:22
 */

namespace app\admin;
trait Common
{
    use \app\common\Send, \app\common\Parameter;
    protected $adminUserInfo = null;

    public function __construct()
    {
    }

    final protected function isLogin()
    {
    }

    /**
     * 记录管理员后台操作日志
     *
     * @param $action
     *
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    final protected function actionLog($action)
    {
    }

    /**
     * 通过表名和数据主键 ID, 更改数据的status(状态)
     *
     * @param $id     需要修改的数据 ID
     * @param $model  需要修改的数据model(表名)名称
     * @param $status 需要修改的 status
     *
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    final protected function changeStatus($id, $model, $status)
    {
        $m = model($model);
        $data = [
            'id'     => $id,
            'status' => $status,
        ];
        $result = $m->isUpdate(true)->save($data);
        if ($result) {
            $this->success('操作成功');
        } else {
            $this->error('操作失败,稍后再试~~~');
        }
    }

    /**
     * 禁用数据
     *
     * @param $id    需要禁用的数据 ID
     * @param $model 需要禁用数据的 model(表名)
     *
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    final protected function diabsleStatus($id, $model)
    {
        $this->changeStatus($id, $model, 0);
    }

    /**
     * 启用数据
     *
     * @param $id    需要启用的数据 ID
     * @param $model 需要启用数据的 model(表名)
     *
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    final protected function enabledStatus($id, $model)
    {
        $this->changeStatus($id, $model, 1);
    }

    /**
     * @param $id    需要删除的数据 ID
     * @param $model 需要删除数据的 model(表名)
     *
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    final protected function delStatus($id, $model)
    {
        $this->changeStatus($id, $model, -1);
    }

    /**
     * 判断是否传递了操作
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    protected function isAction()
    {
        $action = input('action');
        if ( ! $action) {
            $this->error('请选择需要的操作');
        }
    }

    /**
     * 判断是都 post id action 同时满足
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    final protected function isPostAndIdAndAction()
    {
        $this->isPost();
        $this->isId();
        $this->isAction();
    }

    /**
     * status 操作
     *
     * @param $model  mode
     * @param $action 操作
     *
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    final protected function statusAction($model)
    {
        $this->isPostAndIdAndAction();
        $id = input('id');
        $action = input('action');
        if ($action == 'disabled') {
            $this->diabsleStatus($id, $model);
        } else if ($action == 'enabled') {
            $this->enabledStatus($id, $model);
        } else if ($action == 'deleted') {
            $this->delStatus($id, $model);
        } else {
            $this->error('未知操作~~~');
        }
    }

    /**
     * 快速验证数据
     *
     * @param        $validate 验证器名称
     * @param        $data     需要验证的数据
     * @param array  $rules    规则
     * @param string $scene    场景
     *
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    final protected function validateData($validate, $data, $rules = [], $scene = '')
    {
        $vali = validate($validate);
        if ( ! $vali->check($data, $rules, $scene)) {
            $this->error($vali->getError());
        }
    }

    /**
     * 验证操作是否成功,并且处理行为,返回信息
     *
     * @param        $action
     * @param string $actionLog
     *
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    final protected function checkSuccessOrError($action, $actionLog = '')
    {
        if ($action) {
            if ($actionLog) {
                $this->actionLog($actionLog);
            }
            $this->success('操作成功');
        }

        $this->error('未知错误,稍后再试试');
    }
}