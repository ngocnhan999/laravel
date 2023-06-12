<?php

namespace App\Repositories\Student\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface StudentInformationInterface extends RepositoryInterface
{
    public function getShow($id);
}
