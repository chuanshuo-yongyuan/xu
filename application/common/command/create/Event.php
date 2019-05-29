<?php
/**
 * FileName: Event.php
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

class Event extends Create
{
    protected $type = "Event";

    protected function configure()
    {
        parent::configure();
        $this->setName('create:event')
            ->setDescription('Create a event class');
    }

    protected function getStub()
    {
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR;

        return $stubPath . 'event.stub';
    }

    protected function getNamespace($appNamespace, $module)
    {
        return parent::getNamespace($appNamespace, $module) . '\event';
    }
}