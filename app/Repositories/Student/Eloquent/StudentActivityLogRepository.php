<?php

namespace App\Repositories\Student\Eloquent;

use App\Repositories\Student\Interfaces\StudentActivityLogInterface;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;

class StudentActivityLogRepository extends RepositoriesAbstract implements StudentActivityLogInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAllLogs($member_id, $paginate = 10)
    {
        return $this->model
            ->where('student_id', $member_id)
            ->latest('created_at')
            ->paginate($paginate);
    }
}
