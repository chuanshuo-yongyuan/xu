<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Ads extends Migrator
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
         * 广告表
         * */
        $table = $this->table('ads', ['comment' => '广告表']);
        $table->addColumn('name', 'string', ['limit' => 100, 'comment' => '广告名称'])
            ->addColumn('img', 'string', ['limit' => 500, 'comment' => '广告图片', 'default' => ''])
            ->addColumn('url', 'string', ['limit' => 500, 'comment' => '跳转地址', 'default' => '###'])
            ->addColumn('position_id', 'integer', ['limit' => 11, 'comment' => '所属位置ID'])
            ->addColumn('start_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '有效起始时间'])
            ->addColumn('end_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '有效结束时间'])
            ->addColumn('sort', 'integer', ['limit' => 3, 'default' => 0, 'comment' => '排序,越大越在前面'])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1, 'comment' => '状态'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '修改时间'])
            ->create();
    }
}
