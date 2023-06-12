<?php

namespace App\Repositories\Province\Eloquent;

use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\Province\Interfaces\ProvinceInterface;

class ProvinceRepository extends RepositoriesAbstract implements ProvinceInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed|void
     */
    public function getList($prependList = [], $appendList = [])
    {
        $all = $this->model->all(['id', 'name'])->toArray();
        $list = array_column($all, 'name', 'id');
        foreach ($list as $key => $title)
            $prependList[$key] = $title;
        foreach ($appendList as $key => $title)
            $prependList[$key] = $title;
        return $prependList;
    }
    public function province($province_id)
    {
        $query = $this->model->select('*')->where('id', '=', $province_id);
        return $this->applyBeforeExecuteQuery($query)->first();
    }
}
