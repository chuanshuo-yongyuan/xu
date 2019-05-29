<?php

use think\migration\Migrator;
use think\migration\db\Column;

class StoresChange extends Migrator
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
        $table->addColumn('category_id', 'integer', ['after'=>'circle_id','limit' => 11, 'default' => 0, 'comment' => '店铺所属类型'])
            ->save();
    }
}
