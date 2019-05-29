<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Comments extends Migrator
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
         * 评论
         * */
        $table = $this->table('comments', ['comment' => '评论表']);
        $table->addColumn('content', 'string', ['limit' => 500, 'default' => '', 'comment' => '评论内容'])
            ->addColumn('business_id', 'integer', ['limit' => 11, 'default' => 0, 'comment' => ' 商家ID'])
            ->addColumn('store_id', 'integer', ['limit' => 11, 'default' => 0, 'comment' => ' 店铺 ID'])
            ->addColumn('user_id', 'integer', ['limit' => 11, 'default' => 0, 'comment' => ' 用户 ID'])
            ->addColumn('order_id', 'integer', ['limit' => 11, 'default' => 0, 'comment' => ' 评论所属订单 ID'])
            ->addColumn('is_additional', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '是否为追评,0-否,1-是'])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1, 'comment' => '状态,-1-删除,0-禁用,1-显示'])
            ->addColumn('score', 'decimal', ['precision' => 10, 'scale' => 1, 'signed' => true, 'default' => 0.00, 'comment' => '评分'])
            ->addColumn('comment_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '评论时间'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '创建时间'])
            ->create();
    }
}
