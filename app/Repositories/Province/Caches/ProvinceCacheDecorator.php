<?php

namespace App\Repositories\Province\Caches;


use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\Province\Interfaces\ProvinceInterface;

class ProvinceCacheDecorator extends CacheAbstractDecorator implements ProvinceInterface
{
    /**
     * {@inheritdoc}
     */
    public function getList($prependList = [], $appendList = [])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function province($province_id)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
