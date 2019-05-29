<?php

use think\migration\Seeder;

class Categories extends Seeder
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
        $faker = Faker\Factory::create('zh_CN');
        $datas = [];
        $len = 50;
        for ($i = 0; $i < $len; $i++) {
            if ($i > 6 && $i < 25) {
                $pid = mt_rand(1, 6);
            } elseif ($i > 24 && $i < 50) {
                $pid = mt_rand(6, 25);
            } else {
                $pid = 0;
            }
            $data = [
                'name' => $faker->sentence(),
                'pid'  => $pid,
            ];
            $datas[] = $data;
        }
        $table = $this->table('categories');
        $table->insert($datas)->save();
    }
}