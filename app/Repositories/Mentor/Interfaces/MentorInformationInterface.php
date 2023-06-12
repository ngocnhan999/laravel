<?php

namespace App\Repositories\Mentor\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface MentorInformationInterface extends RepositoryInterface
{
    public function getShow($id);
}
