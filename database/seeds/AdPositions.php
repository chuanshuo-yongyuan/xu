<?php

use think\migration\Seeder;

class AdPositions extends Seeder
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
        $len = 10;
        for ($i = 0; $i < $len; $i++) {
            $data = [
                'name'  => $faker->realText(),
                'title' => $faker->uuid,
                'desc'  => $faker->text(),
            ];
            $datas[] = $data;
        }
        $table = $this->table('ad_positions');
        $table->insert($datas)->save();
    }
}