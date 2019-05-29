<?php

use think\migration\Seeder;

class Stores extends Seeder
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
        $len = 50;
        for ($i = 0; $i < $len; $i++) {
            $photo = [
                $faker->imageUrl(),
                $faker->imageUrl(),
                $faker->imageUrl(),
                $faker->imageUrl(),
                $faker->imageUrl(),
                $faker->imageUrl(),
                $faker->imageUrl(),
                $faker->imageUrl(),
                $faker->imageUrl(),
                $faker->imageUrl(),
                $faker->imageUrl(),
                $faker->imageUrl(),
            ];
            $data = [
                'name'        => $faker->sentence(),
                'business_id' => mt_rand(1, 50),
                'circle_id'   => mt_rand(1, 50),
                'category_id' => mt_rand(1, 50),
                'img'         => $faker->imageUrl(),
                'logo'        => $faker->imageUrl(),
                'photo'       => serialize($photo),
                'intro'       => $faker->text,
                'desc'        => $faker->text,
                'longitude'   => $faker->longitude,
                'latitude'    => $faker->latitude,
                'tel'         => $faker->phoneNumber,
                'phone'       => $faker->phoneNumber,
                'address'     => $faker->streetAddress,
                'score'       => $faker->randomFloat(2, 1, 4),
                'comment_num' => $faker->randomNumber(),
                'click_num'   => $faker->randomNumber()
//                'area_id' => $area[ mt_rand(0, count($area)) ],
            ];
            $datas[] = $data;
        }
        $table = $this->table('stores');
        $table->insert($datas)->save();
    }
}