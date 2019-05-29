<?php
/**
 * FileName: Common.php
 * ==============================================
 * Copy right 2016-2017
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: 永 | <chuanshuo_yongyuan@163.com>
 * @date  : 2018/9/1 15:40
 */

namespace app\common\model;


use think\Model;

class Common extends Model
{
    protected $hidden = ['create_time', 'update_time'];
    protected $autoWriteTimestamp = true;
    protected $globalScope = ['status'];

    public function getStatusTextAttr($value, $data)
    {
        $status = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];

        return $status[ $data['status'] ];
    }

    public function scopeStatus($query)
    {
        $query->where('status', '>', -1);
    }
}