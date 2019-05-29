<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Cards extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        /*
         * 券
         * */
        $table = $this->table('cards', ['comment' => '商家店铺表']);
        $table->addColumn('name', 'string', ['limit' => 30, 'comment' => '名称'])
            ->addColumn('business_id', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '所属商家ID'])
            ->addColumn('store_id', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '所属店铺ID'])
            ->addColumn('img', 'string', ['limit' => 500, 'comment' => '图片'])
            ->addColumn('intro', 'string', ['limit' => 500, 'null' => true, 'comment' => '简介'])
            ->addColumn('desc', 'text', ['null' => true, 'comment' => '详细信息'])
            ->addColumn('original_price', 'decimal', ['precision' => 10, 'scale' => 2, 'signed' => true, 'default' => 0.00, 'comment' => '原价'])
            ->addColumn('price', 'decimal', ['precision' => 10, 'scale' => 2, 'signed' => true, 'default' => 0.00, 'comment' => '单价'])
            ->addColumn('discount', 'decimal', ['precision' => 10, 'scale' => 2, 'signed' => true, 'default' => 0.00, 'comment' => '折扣'])
            ->addColumn('use_time', 'integer', ['limit' => 1, 'default' => 0, 'comment' => '可用时间 0-不限，1-工作日，2-周末，3-节假日'])
            ->addColumn('period_time', 'integer', ['limit' => 1, 'default' => 0, 'comment' => '可用时段 0-不限，1-午餐，2-晚餐，3-夜宵'])
            ->addColumn('number', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '数量'])
            ->addColumn('sales_num', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '销量'])
            ->addColumn('limit_buy_num', 'integer', ['limit' => 11, 'default' => 99, 'comment' => '限购数量'])
            ->addColumn('start_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '使用开始时间'])
            ->addColumn('end_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '可用结束时间'])
            ->addColumn('is_refund', 'integer', ['limit' => 1, 'default' => 0, 'comment' => '是否可退0-不，1-可'])
            ->addColumn('refund_amount', 'decimal', ['precision' => 10, 'scale' => 2, 'signed' => true, 'default' => 0.00, 'comment' => '退款手续费'])
            ->addColumn('click_num', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '热度'])
            ->addColumn('sort', 'integer', ['limit' => 3, 'default' => 0, 'comment' => '排序,越大越在前面'])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1, 'comment' => '状态'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '修改时间'])
            ->create();
    }
}
