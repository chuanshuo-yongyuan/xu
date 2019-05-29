<?php

use think\migration\Seeder;

class Comments extends Seeder
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
        $len = 300;
        for ($i = 0; $i < $len; $i++) {
            $data = [
                'content'       => $faker->realText(),
                'business_id'   => mt_rand(1, 50),
                'store_id'      => mt_rand(1, 50),
                'user_id'       => $faker->uuid,
                'user_name'     => $faker->userName,
                'user_avatar'   => $faker->imageUrl(),
                'order_id'      => mt_rand(1, 100),
                'is_additional' => mt_rand(0, 1),
                'score'         => $faker->randomFloat(2, 1, 4),
                'comment_time'  => $faker->dateTimeBetween($startDate = '-30 days', $endDate = '1 days')->getTimestamp(),
            ];
            $datas[] = $data;
        }
        $table = $this->table('comments');
        $table->insert($datas)->save();
    }
}