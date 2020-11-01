<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/dashboard',
            'new-tab' => false,
        ],
        //Admins
        [
            'section' => 'Users',
        ],
        [
            'title' => 'Users',
            'icon' => 'media/svg/icons/Communication/Address-card.svg',
            'page' => '/users',
            'new-tab' => false,

        ],
        [
            'title' => 'Add new user',
            'icon' => 'media/svg/icons/Communication/Add-user.svg',
            'page' => '/users/create',
            'new-tab' => false,

        ],
        //roles
        [
            'section' => 'roles',
        ],
        [
            'title' => 'Roles',
            'icon' => 'media/svg/icons/Communication/Address-card.svg',
            'page' => '/roles',
            'new-tab' => false,

        ],
        [
            'title' => 'Add role',
            'icon' => 'media/svg/icons/Communication/Address-card.svg',
            'page' => '/roles/create',
            'new-tab' => false,

        ],
        // Custom
        [
            'section' => 'Custom',
        ],
        [
            'title' => 'Applications',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Users',
                    'bullet' => 'dot',
                    'submenu' => [
                        [
                            'title' => 'List - Default',
                            'page' => 'test',
                        ],
                        [
                            'title' => 'List - Datatable',
                            'page' => 'custom/apps/user/list-datatable'
                        ],
                        [
                            'title' => 'List - Columns 1',
                            'page' => 'custom/apps/user/list-columns-1'
                        ],
                        [
                            'title' => 'List - Columns 2',
                            'page' => 'custom/apps/user/list-columns-2'
                        ],
                        [
                            'title' => 'Add User',
                            'page' => 'custom/apps/user/add-user'
                        ],
                        [
                            'title' => 'Edit User',
                            'page' => 'custom/apps/user/edit-user'
                        ],
                    ]

            ]
          ]
        ]
    ]

];
