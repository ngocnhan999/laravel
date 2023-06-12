<?php

namespace App\Repositories\Student\Eloquent;

use App\Repositories\Student\Interfaces\StudentInformationInterface;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;

class StudentInformationRepository extends RepositoriesAbstract implements StudentInformationInterface
{
    public function getShow($id)
    {
        $query = $this->model->select('*')->where('student_id', '=', $id);
        return $this->applyBeforeExecuteQuery($query)->first();
    }
}
