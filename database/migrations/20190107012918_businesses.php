<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Businesses extends Migrator
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
         * 商家
         * */
        $table = $this->table('businesses', ['comment' => '商家信息表']);
        $table->addColumn('name', 'string', ['limit' => 30, 'comment' => '名称'])
            ->addColumn('img', 'string', ['limit' => 500, 'comment' => '商家图集'])
            ->addColumn('logo', 'string', ['limit' => 500, 'comment' => '商家 logo'])
            ->addColumn('photo', 'text', ['null' => true, 'comment' => '商家图集'])
            ->addColumn('intro', 'string', ['limit' => 500, 'null' => true, 'comment' => '商家简介'])
            ->addColumn('desc', 'text', ['null' => true, 'comment' => '商家详细信息'])
            ->addColumn('sort', 'integer', ['limit' => 3, 'default' => 0, 'comment' => '排序,越大越在前面'])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1, 'comment' => '状态'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '修改时间'])
            ->create();
    }
}
