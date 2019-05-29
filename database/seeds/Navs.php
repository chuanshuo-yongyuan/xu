<?php

use think\migration\Seeder;

class Navs extends Seeder
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
        $len = 30;
        for ($i = 0; $i < $len; $i++) {
            $data = [
                'name' => $faker->sentence(),
                'url'  => $faker->url,
                'img'  => $faker->imageUrl(),
                'position_id' => mt_rand(1, 10),
            ];
            $datas[] = $data;
        }
        $table = $this->table('navs');
        $table->insert($datas)->save();
    }
}