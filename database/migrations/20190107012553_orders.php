<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Orders extends Migrator
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
         * 订单表
         * */
        $table = $this->table('orders', ['comment' => '订单表']);
        $table->addColumn('sn', 'string', ['limit' => 32, 'comment' => '订单 sn'])
            ->addColumn('pay_sn', 'string', ['limit' => 32, 'comment' => '支付SN'])
            ->addColumn('business_id', 'integer', ['limit' => 11, 'comment' => '商家ID'])
            ->addColumn('store_id', 'integer', ['limit' => 11, 'comment' => '店铺ID'])
            ->addColumn('card_id', 'integer', ['limit' => 11, 'comment' => '券ID'])
            ->addColumn('user_id', 'string', ['limit' => 50, 'comment' => '用户ID'])
            ->addColumn('user_name', 'string', ['limit' => 50, 'null' => true, 'comment' => '用户名称'])
            ->addColumn('card_num', 'integer', ['limit' => 11, 'comment' => '券数量'])
            ->addColumn('card_price', 'decimal', ['precision' => 10, 'scale' => 2, 'signed' => true, 'default' => 0.00, 'comment' => '券单价'])
            ->addColumn('card_amount', 'decimal', ['precision' => 10, 'scale' => 2, 'signed' => true, 'default' => 0.00, 'comment' => '券总价'])
            ->addColumn('order_amount', 'decimal', ['precision' => 10, 'scale' => 2, 'signed' => true, 'default' => 0.00, 'comment' => '订单总价'])
            ->addColumn('rcb_amount', 'decimal', ['precision' => 10, 'scale' => 2, 'signed' => true, 'default' => 0.00, 'comment' => '充值卡支付金额'])
            ->addColumn('pd_amount', 'decimal', ['precision' => 10, 'scale' => 2, 'signed' => true, 'default' => 0.00, 'comment' => '预存款支付金额'])
            ->addColumn('voucher_price', 'decimal', ['precision' => 10, 'scale' => 2, 'signed' => true, 'default' => 0.00, 'comment' => '代金券面额'])
            ->addColumn('voucher_code', 'string', ['limit' => 64, 'null' => true, 'comment' => '代金券SN'])
            ->addColumn('pay_amount', 'decimal', ['precision' => 10, 'scale' => 2, 'signed' => true, 'default' => 0.00, 'comment' => '实际支付金额'])
            ->addColumn('refund_amount', 'decimal', ['precision' => 10, 'scale' => 2, 'signed' => true, 'default' => 0.00, 'comment' => '退款金额'])
            ->addColumn('pay_type', 'string', ['limit' => 32, 'comment' => '支付方式'])
            ->addColumn('order_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '订单时间'])
            ->addColumn('pay_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '支付时间时间'])
            ->addColumn('over_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '订单完成时间'])
            ->addColumn('order_pointscount', 'integer', ['limit' => 3, 'default' => 0, 'comment' => '订单赠送积分'])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 0, 'comment' => '状态,-1-取消,0-待支付,1-已支付,2-已使用,3-已评论,4-已退款'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '修改时间'])
            ->addIndex(['user_id', 'business_id', 'store_id', 'card_id'])
            ->create();
    }
}
