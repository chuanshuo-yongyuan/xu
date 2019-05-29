<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CommentLabels extends Migrator
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
         * 评论标签
         * */
        $table = $this->table('comment_labels',['comment'=>'评论标签']);
        $table->addColumn('comment_id', 'integer', ['limit' => 11, 'comment' => '评论ID'])
            ->addColumn('label_id', 'integer', ['limit' => 11, 'comment' => '标签ID'])
            ->create();
    }
}
