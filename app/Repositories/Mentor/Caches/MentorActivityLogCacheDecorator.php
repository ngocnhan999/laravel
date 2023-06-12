<?php

namespace App\Repositories\Mentor\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\Mentor\Interfaces\MentorActivityLogInterface;

class MentorActivityLogCacheDecorator extends CacheAbstractDecorator implements MentorActivityLogInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAllLogs($member_id, $paginate = 10)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
