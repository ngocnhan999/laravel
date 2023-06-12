<?php

namespace App\Repositories\Student\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\Student\Interfaces\StudentActivityLogInterface;

class StudentActivityLogCacheDecorator extends CacheAbstractDecorator implements StudentActivityLogInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAllLogs($member_id, $paginate = 10)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
