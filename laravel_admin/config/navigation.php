<?php

return array (
    // Navigation configuration for Admin Menu
    'admin' => array (
        array (
            'title' => "navbar.dashboard",
            'permission' => "admin_dashboard",
            'icon' => 'fa fa-desktop',
            'options' => array (
                'action' => "Admin\DashboardController@getIndex"
            ),
        ),

        array (
            'title' => "navbar.user_management",
            'permission' => "user_management",
            'icon' => 'fa fa-gears',
            'options' => array (
                'url' => "#"
            ),
            'childrens' => array(
                array (
                    'title' => "navbar.users",
                    'permission' => "view_users",
                    'icon' => 'fa fa-users',
                    'options' => array (
                        'action' => "Admin\UserController@index"
                    ),
                    'childrens' => array(
                        array(
                            'title' => "navbar.create_users",
                            'permission' => "add_user",
                            'visible'	=> false,
                            'options' => array (
                                'action' => "Admin\UserController@create"
                            )
                        ),
                        array(
                            'title' => "navbar.edit_users",
                            'permission' => "edit_user",
                            'visible'	=> false,
                            'options' => array (
                                'url' => "user/edit"
                            )
                        )
                    )
                ),
                array (
                    'title' => "navbar.roles",
                    'permission' => "view_roles",
                    'icon' => 'fa fa-sitemap',
                    'options' => array (
                        'action' => "Admin\RoleController@index"
                    ),
                    'childrens' => array(
                        array(
                            'title' => "navbar.create_role",
                            'permission' => "add_role",
                            'visible'	=> false,
                            'options' => array (
                                'action' => "Admin\RoleController@create"
                            )
                        ),
                        array(
                            'title' => "navbar.edit_role",
                            'permission' => "edit_role",
                            'visible'	=> false,
                            'options' => array (
                                'url' => "role/edit"
                            )
                        )
                    )
                )
            )
        ),
        array (
            'title' => "navbar.company_management",
            'permission' => "company_management",
            'icon' => 'fa fa-building-o',
            'options' => array (
                'action' => "Admin\CompanyController@index"
            ),
            'childrens' => array(
                array (
                    array(
                        'title' => "navbar.create_company",
                        'permission' => "add_company",
                        'visible'	=> false,
                        'options' => array (
                            'action' => "Admin\CompanyController@create"
                        )
                    ),
                    array(
                        'title' => "navbar.edit_company",
                        'permission' => "edit_company",
                        'visible'	=> false,
                        'options' => array (
                            'url' => "company/edit"
                        )
                    ),
                    array(
                        'title' => "navbar.delete_company",
                        'permission' => "delete_company",
                        'visible'	=> false,
                        'options' => array (
                            'url' => "company/delete"
                        )
                    )
                )
            )
        ),
        array (
            'title' => "navbar.masters",
            'permission' => "masters",
            'icon' => 'fa fa-briefcase',
            'options' => array (
                'url' => "#"
            ),
            'childrens' => array(
                array(
                    'title' => "navbar.regions",
                    'icon' => 'fa fa-map-marker',
                    'permission' => "regions_management",
                    'visible'	=> true,
                    'options' => array (
                        'url' => "#"
                    )
                ),
                array(
                    'title' => "navbar.currency",
                    'icon' => 'fa fa-money',
                    'permission' => "currency_management",
                    'visible'	=> true,
                    'options' => array (
                        'url' => "#"
                    )
                ),
                array(
                    'title' => "navbar.project",
                    'icon' => 'fa fa-product-hunt',
                    'permission' => "project_management",
                    'visible'	=> true,
                    'options' => array (
                        'url' => "#"
                    )
                ),
                array(
                    'title' => "navbar.vouchers",
                    'permission' => "vouchers_management",
                    'icon' => 'fa fa-gift',
                    'visible'	=> true,
                    'options' => array (
                        'url' => "#"
                    )
                )
            )
        )
    )
);