<?php

namespace App\Repositories\Student\Caches;

use App\Repositories\Student\Interfaces\StudentInterface;
use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;

class StudentCacheDecorator extends CacheAbstractDecorator implements StudentInterface
{

}
