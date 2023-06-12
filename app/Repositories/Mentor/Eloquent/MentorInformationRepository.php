<?php

namespace App\Repositories\Mentor\Eloquent;

use App\Repositories\Mentor\Interfaces\MentorInformationInterface;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;

class MentorInformationRepository extends RepositoriesAbstract implements MentorInformationInterface
{
    public function getShow($id)
    {
        $query = $this->model->select('*')->where('mentor_id', '=', $id);
        return $this->applyBeforeExecuteQuery($query)->first();
    }
}
