<?php

use think\migration\Seeder;

class Articles extends Seeder
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
                'title'        => $faker->sentence(),
                'content'      => $faker->realText(),
                'publish_time' => $faker->dateTimeBetween($startDate = '-30 days', $endDate = '30 days')->getTimestamp(),
                'click'        => $faker->randomNumber(),
                'img'          => $faker->imageUrl(),
            ];
            $datas[] = $data;
        }
        $table = $this->table('articles');
        $table->insert($datas)->save();
    }
}