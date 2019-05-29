<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Stores extends Migrator
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
         * 店铺
         * */
        $table = $this->table('stores', ['comment' => '商家店铺表']);
        $table->addColumn('name', 'string', ['limit' => 30, 'comment' => '名称'])
            ->addColumn('business_id', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '所属商家ID'])
            ->addColumn('circle_id', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '所属商圈ID'])
            ->addColumn('img', 'string', ['limit' => 500, 'comment' => '商家图集'])
            ->addColumn('logo', 'string', ['limit' => 500, 'comment' => '商家 logo'])
            ->addColumn('photo', 'text', ['null' => true, 'comment' => '商家图集'])
            ->addColumn('intro', 'string', ['limit' => 500, 'null' => true, 'comment' => '商家简介'])
            ->addColumn('desc', 'text', ['null' => true, 'comment' => '商家详细信息'])
            ->addColumn('longitude', 'string', ['limit' => 60, 'comment' => '经度'])
            ->addColumn('latitude', 'string', ['limit' => 60, 'comment' => '纬度'])
            ->addColumn('tel', 'string', ['limit' => 60, 'comment' => '联系电话'])
            ->addColumn('phone', 'string', ['limit' => 60, 'comment' => '联系手机'])
            ->addColumn('address', 'string', ['limit' => 300, 'comment' => '详细地址'])
            ->addColumn('score', 'decimal', ['precision' => 10, 'scale' => 2, 'signed' => true, 'default' => 0.00, 'comment' => '评分'])
            ->addColumn('comment_num', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '评论条数'])
            ->addColumn('click_num', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '热度'])
            ->addColumn('sort', 'integer', ['limit' => 3, 'default' => 0, 'comment' => '排序,越大越在前面'])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1, 'comment' => '状态'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '修改时间'])
            ->create();
    }
}
