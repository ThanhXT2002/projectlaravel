<?php

return [
    'module' => [
        [
            'title' => 'QL Sản Phẩm',
            'icon' => 'fab fa-product-hunt',
            'name' => ['product', 'attribute'],
            'subModule' => [
                [
                    'title' => 'QL sản phẩm',
                    'route' => 'product.index',
                    'icon' => 'fas fa-cube',
                ],
                [
                    'title' => 'QL loại sản phẩm',
                    'route' => 'product.catalogue.index',
                    'icon' => 'fas fa-cubes',
                ],
                [
                    'title' => 'QL thuộc tính',
                    'route' => 'attribute.index',
                    'icon' => 'fas fa-cubes',
                ],
                [
                    'title' => 'QL loại thuộc tính',
                    'route' => 'attribute.catalogue.index',
                    'icon' => 'fas fa-cubes',
                ],
            ],
        ],
        [
            'title' => 'QL Nhóm Bài Viết',
            'icon' => 'fas fa-pencil-ruler',
            'name' => ['post'],
            'subModule' => [
                [
                    'title' => 'QL bài viết',
                    'route' => 'post.index',
                    'icon' => 'fas fa-newspaper',
                ],
                [
                    'title' => 'QL loại bài viết',
                    'route' => 'post.catalogue.index',
                    'icon' => 'fas fa-pen-square',
                ],
            ],
        ],
        [
            'title' => 'QL Thành Viên',
            'icon' => 'fas fa-users-cog',
            'name' => ['user', 'permission'],
            'subModule' => [
                [
                    'title' => 'QL thành viên',
                    'route' => 'user.index',
                    'icon' => 'fas fa-user',
                ],
                [
                    'title' => 'QL nhóm thành viên',
                    'route' => 'user.catalogue.index',
                    'icon' => 'fas fa-id-card',
                ],
                [
                    'title' => 'QL quyền hạn',
                    'route' => 'permission.index',
                    'icon' => 'fas fa-user-tag',
                ],
            ],
        ],
        [
            'title' => 'QL Menu',
            'icon' => 'fas fa-bars',
            'name' => ['menu'],
            'subModule' => [
                [
                    'title' => 'Cài đặt menu',
                    'route' => 'menu.index',
                    'icon' => 'fab fa-elementor',
                ],
            ],
        ],
        [
            'title' => 'Cấu Hình Chung',
            'icon' => 'fas fa-cogs',
            'name' => ['language', 'generate','system'],
            'subModule' => [
                [
                    'title' => 'QL ngôn ngữ',
                    'route' => 'language.index',
                    'icon' => 'fas fa-language',
                ],
                [
                    'title' => 'QL Module',
                    'route' => 'generate.create',
                    'icon' => 'fas fa-brain',
                ],
                [
                    'title' => 'Cấu hình hệ thống',
                    'route' => 'system.index',
                    'icon' => 'fas fa-cog',
                ],
            ],
        ],
    ],
];
