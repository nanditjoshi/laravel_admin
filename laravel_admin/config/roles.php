<?php
return [
    1 => [
        'role' => 'Super Admin',
        'default-users' => [
            "admin@admin.com" => [
                "first_name" => "Super",
                "last_name" => "Admin",
                "password" => "avdevs@123"
            ]
        ],
        'permissions' => [
            'admin_dashboard',
            'user_management',
            'view_roles',
            'add_role',
            'edit_role',
            'delete_role',
            'view_users',
            'add_user',
            'edit_user',
            'delete_user',
            'my_account_view',
            'my_account',
            'company_management',
            'view_companies',
            'add_company',
            'edit_company',
            'delete_company',
            'masters',
            'regions_management',
            'currency_management',
            'project_management',
            'vouchers_management',
        ]
    ],
    2 => [
        'role' => 'Company Admin',
        'default-users' => [
            "organization@admin.com" => [
                "first_name" => "Organization",
                "last_name" => "Admin",
                "password" => "avdevs@123"
            ],
            "charity@admin.com" => [
                "first_name" => "Charity",
                "last_name" => "Admin",
                "password" => "avdevs@123"
            ]
        ],
        'permissions' => [
            'admin_dashboard',
            'my_account_view',
            'my_account',
            'user_management',
            'view_users',
            'add_user',
            'edit_user',
            'delete_user',
            'masters',
            'regions_management',
            'currency_management',
            'project_management',
            'vouchers_management',
        ]
    ],
    3 => [
        'role' => 'Company User',
        'default-users' => [
            "jiten@avdevs.com" => [
                "first_name" => "Jiten",
                "last_name" => "Patel",
                "password" => "avdevs@123"
            ]
        ],
        'permissions' => [
            'admin_dashboard',
            'my_account_view',
            'my_account',
            'masters',
            'regions_management',
            'project_management',
        ]
    ]
];