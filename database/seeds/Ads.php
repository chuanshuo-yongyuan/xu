<?php

use think\migration\Seeder;

class Ads extends Seeder
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
            $data = [
                'name'        => $faker->realText(),
                'img'         => $faker->imageUrl(),
                'url'         => $faker->url,
                'position_id' => mt_rand(1, 10),
                'start_time'  => $faker->dateTimeBetween($startDate = '-30 days', $endDate = '-15 days')->getTimestamp(),
                'end_time'    => $faker->dateTimeBetween($startDate = '15 days', $endDate = '30 days')->getTimestamp(),
            ];
            $datas[] = $data;
        }
        $table = $this->table('ads');
        $table->insert($datas)->save();
    }
}