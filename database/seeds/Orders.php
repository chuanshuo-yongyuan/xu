<?php

use think\migration\Seeder;

class Orders extends Seeder
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
        $len = 100;
        for ($i = 0; $i < $len; $i++) {
            $data = [
                'sn'                => $faker->uuid,
                'pay_sn'            => $faker->uuid,
                'business_id'       => mt_rand(1, 50),
                'store_id'          => mt_rand(1, 50),
                'user_id'           => $faker->uuid,
                'card_id'           => mt_rand(1, 500),
                'user_name'         => $faker->userName,
                'user_avatar'       => $faker->imageUrl(),
                'card_num'          => mt_rand(1, 5),
                'card_price'        => $faker->randomFloat(2, 100, 200),
                'card_amount'       => $faker->randomFloat(2, 200, 300),
                'order_amount'      => $faker->randomFloat(2, 200, 300),
                'rcb_amount'        => 0.00,
                'pd_amount'         => 0.00,
                'voucher_price'     => 0.00,
                'voucher_code'      => '',
                'pay_amount'        => '',
                'refund_amount'     => 0.00,
                'pay_type'          => 'wechat',
                'order_time'        => $faker->dateTimeBetween($startDate = '-30 days', $endDate = '1 days')->getTimestamp(),
                'pay_time'          => $faker->dateTimeBetween($startDate = '-30 days', $endDate = '1 days')->getTimestamp(),
                'over_time'         => $faker->dateTimeBetween($startDate = '10 days', $endDate = '15 days')->getTimestamp(),
                'order_pointscount' => mt_rand(100, 500),
            ];
            $datas[] = $data;
        }
        $table = $this->table('orders');
        $table->insert($datas)->save();
    }
}