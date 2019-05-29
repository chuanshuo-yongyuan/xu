<?php

use think\migration\Migrator;

class CommentsChange extends Migrator
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
        $table = $this->table('comments', ['comment' => '评论信息表']);
        $table->addColumn('user_name', 'string', ['after' => 'user_id', 'limit' => 64, 'default' => 0, 'comment' => '用户名'])
            ->addColumn('user_avatar', 'string', ['after' => 'user_name', 'limit' => 200, 'default' => 0, 'comment' => '用户头像'])
            ->save();
    }
}
