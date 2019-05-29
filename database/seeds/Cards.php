<?php

use think\migration\Seeder;

class Cards extends Seeder
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
        $area = [624374, 624375, 624486, 624599, 624730, 624860, 625034, 625111, 625255, 625337, 625486, 625585, 625669, 625883, 626074];
        $datas = [];
        $len = 500;
        for ($i = 0; $i < $len; $i++) {
            $data = [
                'name'           => $faker->sentence(),
                'business_id'    => mt_rand(1, 50),
                'store_id'       => mt_rand(1, 50),
                'img'            => $faker->imageUrl(),
                'intro'          => $faker->text,
                'desc'           => $faker->text,
                'original_price' => $faker->randomFloat(2, 200, 500),
                'price'          => $faker->randomFloat(2, 100, 200),
                'discount'       => $faker->randomFloat(2, 0, 1),
                'use_time'      => mt_rand(0, 3),
                'period_time'   => mt_rand(0, 3),
                'number'        => $faker->randomNumber(),
                'sales_num'     => $faker->randomNumber(),
                'limit_buy_num' => mt_rand(0, 5),
                'start_time'    => $faker->dateTimeBetween($startDate = '-30 days', $endDate = '15 days')->getTimestamp(),
                'end_time'      => $faker->dateTimeBetween($startDate = '15 days', $endDate = '60 days')->getTimestamp(),
                'is_refund'     => mt_rand(0, 1),
                'refund_amount' => $faker->randomFloat(2, 10, 20),
                'click_num'     => $faker->randomNumber(),
            ];
            $datas[] = $data;
        }
        $table = $this->table('cards');
        $table->insert($datas)->save();
    }
}