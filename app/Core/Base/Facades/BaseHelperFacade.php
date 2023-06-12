<?php

namespace App\Core\Base\Facades;

use App\Core\Base\Helpers\BaseHelper;
use Illuminate\Support\Facades\Facade;

class BaseHelperFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BaseHelper::class;
    }
}
