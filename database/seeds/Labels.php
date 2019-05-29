<?php

use think\migration\Seeder;

class Labels extends Seeder
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
        $len = 150;
        for ($i = 0; $i < $len; $i++) {
            $data = [
                'name' => $faker->sentence(),
                'type' => mt_rand(1, 4),
            ];
            $datas[] = $data;
        }
        $table = $this->table('labels');
        $table->insert($datas)->save();
    }
}