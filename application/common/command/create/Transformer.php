<?php
/**
 * FileName: Transformer.php
 * ==============================================
 * Copy right 2016-2018
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: 永 | <chuanshuo_yongyuan@163.com>
 * @date  : 2019-01-11 10:17
 */

namespace app\common\command\create;


use app\common\command\Create;

class Transformer extends Create
{
    protected $type = "Transformer";

    protected function configure()
    {
        parent::configure();
        $this->setName('create:transformer')
            ->setDescription('Create a transformer class');
    }

    protected function getStub()
    {
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR;

        return $stubPath . 'transformer.stub';
    }

    protected function getNamespace($appNamespace, $module)
    {
        return parent::getNamespace($appNamespace, $module) . '\transformer';
    }
}