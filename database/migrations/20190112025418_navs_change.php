<?php

use think\migration\Migrator;
use think\migration\db\Column;

class NavsChange extends Migrator
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
         * 导航表休息
         * */
        $table = $this->table('navs', ['comment' => '商家店铺表']);
        $table->addColumn('position_id', 'integer', ['after'=>'name','limit' => 11, 'default' => 0, 'comment' => '导航所属位置'])
            ->save();
    }
}
