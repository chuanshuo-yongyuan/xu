<?php

use think\migration\Seeder;

class StoreLabels extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $datas = [];
        $len = 550;
        for ($i = 0; $i < $len; $i++) {
            $data = [
                'store_id'  => mt_rand(1, 50),
                'label_id' => mt_rand(1, 150),
            ];
            $datas[] = $data;
        }
        $table = $this->table('store_labels');
        $table->insert($datas)->save();
    }
}