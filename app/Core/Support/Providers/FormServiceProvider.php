<?php

namespace App\Core\Support\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Form::component('modalAction', 'forms.partials.modal', [
            'name',
            'title',
            'type'         => null,
            'content'      => null,
            'action_id'    => null,
            'action_name'  => null,
            'action_route' => null,
            'modal_size'   => null
        ]);
    }
}
