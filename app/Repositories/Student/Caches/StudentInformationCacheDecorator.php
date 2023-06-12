<?php

namespace App\Repositories\Student\Caches;

use App\Repositories\Student\Interfaces\StudentInformationInterface;
use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;

class StudentInformationCacheDecorator extends CacheAbstractDecorator implements StudentInformationInterface
{
    public function getShow($id)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

}
