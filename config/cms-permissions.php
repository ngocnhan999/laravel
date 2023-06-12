<?php

return [
    [
        'name' => 'Activities Logs',
        'flag' => 'audit-log.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'audit-log.destroy',
        'parent_flag' => 'audit-log.index'
    ],
    [
        'name' => 'Users',
        'flag' => 'users.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'users.create',
        'parent_flag' => 'users.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'users.edit',
        'parent_flag' => 'users.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'users.destroy',
        'parent_flag' => 'users.index',
    ],

    [
        'name' => 'Roles',
        'flag' => 'roles.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'roles.create',
        'parent_flag' => 'roles.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'roles.edit',
        'parent_flag' => 'roles.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'roles.destroy',
        'parent_flag' => 'roles.index',
    ],
    [
        'name'        => 'Settings',
        'flag'        => 'settings.options',
        'parent_flag' => 'core.system',
    ],
    [
        'name'        => 'Email',
        'flag'        => 'settings.email',
        'parent_flag' => 'settings.options',
    ],
    [
        'name'        => 'Media',
        'flag'        => 'settings.media',
        'parent_flag' => 'settings.options',
    ],
];
