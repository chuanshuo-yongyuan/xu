<?php
/**
 * FileName: Transformer.php
 * ==============================================
 * Copy right 2016-2017
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: 永 | <chuanshuo_yongyuan@163.com>
 * @date  : 2018/1/31 15:28
 */

namespace app\common\transformer;

/**
 * 数据转化基类
 * Class Transformer
 * @package app\common\transformer
 */
abstract class Transformer
{
    /**
     * 基础域名
     * @var string
     */
    protected $baseUrl = '';

    /**
     * 处理数据集
     *
     * @param $items
     *
     * @return array
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    public function transformCollection($items)
    {
        return array_map([$this, 'transform'], $items);
    }

    /**
     * 处理数组
     *
     * @param $item
     *
     * @return mixed
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    public abstract function transform($item);

    /**
     * 获取数据状态
     *
     * @param $status
     *
     * @return mixed
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    protected function getStatusText($status)
    {
        $data = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];

        return $data[ $status ];
    }
}