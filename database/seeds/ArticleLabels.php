<?php

use think\migration\Seeder;

class ArticleLabels extends Seeder
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
        $datas = [];
        $len = 150;
        for ($i = 0; $i < $len; $i++) {
            $data = [
                'article_id'  => mt_rand(1, 150),
                'label_id' => mt_rand(1, 150),
            ];
            $datas[] = $data;
        }
        $table = $this->table('article_labels');
        $table->insert($datas)->save();
    }
}