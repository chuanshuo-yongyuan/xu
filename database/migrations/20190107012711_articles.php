<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Articles extends Migrator
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
         * 咨询表
         * */
        $table = $this->table('articles', ['comment' => '文章表']);
        $table->addColumn('title', 'string', ['limit' => 255, 'default' => '', 'comment' => '文章标题'])
            ->addColumn('content', 'text', ['comment' => '文章内容'])
            ->addColumn('publish_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '发布时间'])
            ->addColumn('click', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '点击数量'])
            ->addColumn('img', 'string', ['limit' => 500, 'default' => '', 'comment' => '新闻头图'])
            ->addColumn('sort', 'integer', ['limit' => 3, 'default' => 0, 'comment' => '排序,越大越在前面'])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1, 'comment' => '状态,-1-删除,0-禁用,1-显示'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '创建时间'])
            ->create();
    }
}
