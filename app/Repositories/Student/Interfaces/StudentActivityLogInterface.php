<?php

namespace App\Repositories\Student\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface StudentActivityLogInterface extends RepositoryInterface
{
    /**
     * @param $member_id
     * @param int $paginate
     * @return Collection
     */
    public function getAllLogs($member_id, $paginate = 10);
}
