<?php

namespace App\Core\Base\Facades;

use App\Core\Base\Helpers\MailVariable;
use Illuminate\Support\Facades\Facade;

class MailVariableFacade extends Facade
{

    /**
     * @return string
     *
     * @since 3.2
     */
    protected static function getFacadeAccessor()
    {
        return MailVariable::class;
    }
}
