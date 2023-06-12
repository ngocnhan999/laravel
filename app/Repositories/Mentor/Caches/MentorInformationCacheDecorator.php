<?php

namespace App\Repositories\Mentor\Caches;

use App\Repositories\Mentor\Interfaces\MentorInformationInterface;
use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;

class MentorInformationCacheDecorator extends CacheAbstractDecorator implements MentorInformationInterface
{
    public function getShow($id)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

}
