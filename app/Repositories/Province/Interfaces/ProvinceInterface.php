<?php

namespace App\Repositories\Province\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface ProvinceInterface extends RepositoryInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = [], $appendList = []);
    public function province($province_id);
}
