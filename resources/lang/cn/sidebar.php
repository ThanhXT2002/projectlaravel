<?php   

return [
    'module' => [
        [
            'title' => '产品管理',
            'icon' => 'fab fa-product-hunt',
            'name' => ['product', 'attribute'],
            'subModule' => [
                [
                    'title' => '产品',
                    'route' => 'product.index',
                    'icon' => 'fas fa-cube',
                ],
                [
                    'title' => '产品类别',
                    'route' => 'product.catalogue.index',
                    'icon' => 'fas fa-cubes',
                ],
                [
                    'title' => '属性',
                    'route' => 'attribute.index',
                    'icon' => 'fas fa-cubes',
                ],
                [
                    'title' => '属性类别',
                    'route' => 'attribute.catalogue.index',
                    'icon' => 'fas fa-cubes',
                ],
            ],
        ],        
        [
            'title' => '文章组管理',
            'icon' => 'fas fa-pencil-ruler',
            'name' => ['post'],
            'subModule' => [
                [
                    'title' => '文章管理',
                    'route' =>  'post.index',
                    'icon' =>  'fas fa-newspaper',
                    'label' => 'post',
                ],
                [
                    'title' => '文章分类管理',
                    'route' =>  'post.catalogue.index',
                    'icon' =>  'fas fa-pen-square',
                    'label' => 'catalogue',
                ],
            ]
        ],
        [
            'title' => '用户组',
            'icon' => 'fas fa-users-cog',
           'name' => ['user','permission'],
            'subModule' => [
                [
                    'title' => '用户',
                    'route' =>  'user.index',
                    'icon' =>  'fas fa-user',
                    'label' => 'user',
                ],
                [
                    'title' => '用户组',
                    'route' =>  'user.catalogue.index',
                    'icon' =>  'fas fa-id-card',
                    'label' => 'catalogue',
                ],
                [
                    'title' => '允许',
                    'route' =>  'permission.index',
                    'icon' =>  'fas fa-user-tag',
                    'label' => 'permission',
                ],
            ],
        ],
        [
            'title' => '菜单管理',
            'icon' => 'fas fa-bars',
            'name' => ['menu'],
            'subModule' => [
                [
                    'title' => '菜单设置',
                    'route' => 'menu.index',
                    'icon' => 'fas fa-elementor',
                ],
            ],
        ],
        [
            'title' => '常规设置',
            'icon' => 'fas fa-cogs',
            'name' => ['language'],
            'subModule' => [
                [
                    'title' => '语言管理',
                    'route' =>  'language.index',
                    'icon' =>  'fas fa-language',
                    'label' => 'language',
                ],
                [
                    'title' => '模块',
                    'route' => 'generate.create',
                    'icon' => 'fas fa-brain',
                ],
                [
                    'title' => '系统配置',
                    'route' => 'system.index',
                    'icon' => 'fas fa-cog',
                ],
            ],
        ],
    ]
];


// return [
//     'module' => [
//         [
//             'title' => '文章',  // Article
//             'icon' => 'fa fa-file',
//             'name' => ['post'],
//             'subModule' => [
//                 [
//                     'title' => '文章组',  // Article Group
//                     'route' => 'post/catalogue/index'
//                 ],
//                 [
//                     'title' => '文章',  // Article
//                     'route' => 'post/index'
//                 ]
//             ]
//         ],
//         [
//             'title' => '用户组',  // User Group
//             'icon' => 'fa fa-user',
//             'name' => ['user'],
//             'subModule' => [
//                 [
//                     'title' => '用户组',  // User Group
//                     'route' => 'user/catalogue/index'
//                 ],
//                 [
//                     'title' => '用户',  // User
//                     'route' => 'user/index'
//                 ],
//                 [
//                     'title' => '权限',
//                     'route' => 'permission/index'
//                 ]
//             ]
//         ],
//         [
//             'title' => '通用',  // General
//             'icon' => 'fa fa-file',
//             'name' => ['language'],
//             'subModule' => [
//                 [
//                     'title' => '语言',  // Language
//                     'route' => 'language/index'
//                 ],
//             ]
//         ]
//     ],
// ];


