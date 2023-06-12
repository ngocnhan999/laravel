<?php

namespace App\Repositories\Mentor\Eloquent;

use App\Repositories\Mentor\Interfaces\MentorActivityLogInterface;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;

class MentorActivityLogRepository extends RepositoriesAbstract implements MentorActivityLogInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAllLogs($member_id, $paginate = 10)
    {
        return $this->model
            ->where('mentor_id', $member_id)
            ->latest('created_at')
            ->paginate($paginate);
    }
}
