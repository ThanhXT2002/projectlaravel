<?php   
return [
    'module' => [
        [
            'title' => 'Product Management',
            'icon' => 'fab fa-product-hunt',
            'name' => ['product', 'attribute'],
            'subModule' => [
                [
                    'title' => 'Products',
                    'route' => 'product.index',
                    'icon' => 'fas fa-cube',
                ],
                [
                    'title' => 'Product Categories',
                    'route' => 'product.catalogue.index',
                    'icon' => 'fas fa-cubes',
                ],
                [
                    'title' => 'Attributes',
                    'route' => 'attribute.index',
                    'icon' => 'fas fa-cubes',
                ],
                [
                    'title' => 'Attribute Categories',
                    'route' => 'attribute.catalogue.index',
                    'icon' => 'fas fa-cubes',
                ],
            ],
        ],
        
        [
            'title' => 'Post Group ',
            'icon' => 'fas fa-pencil-ruler',
            'name' => ['post'],
            'subModule' => [
                [
                    'title' => 'Post Management',
                    'route' =>  'post.index',
                    'icon' =>  'fas fa-newspaper',
                   
                ],
                [
                    'title' => 'Post Cate Management',
                    'route' =>  'post.catalogue.index',
                    'icon' =>  'fas fa-pen-square',
                   
                ],
            ]
        ],
        [
            'title' => 'User Group',
            'icon' => 'fas fa-users-cog',
           'name' => ['user','permission'],
            'subModule' => [
                [
                    'title' => 'User',
                    'route' =>  'user.index',
                    'icon' =>  'fas fa-user',
                    
                ],
                [
                    'title' => 'User Group',
                    'route' =>  'user.catalogue.index',
                    'icon' =>  'fas fa-id-card',
                   
                ],
                [
                    'title' => 'Permission',
                    'route' =>  'permission.index',
                    'icon' =>  'fas fa-user-tag',
                    
                ],
            ],
        ],
        [
            'title' => 'Menu Management',
            'icon' => 'fas fa-bars',
            'name' => ['menu'],
            'subModule' => [
                [
                    'title' => 'Menu Settings',
                    'route' => 'menu.index',
                    'icon' => 'fas fa-elementor',
                ],
            ],
        ],
        [
            'title' => 'General Settings',
            'icon' => 'fas fa-cogs',
            'name' => ['language'],
            'subModule' => [
                [
                    'title' => 'Language',
                    'route' =>  'language.index',
                    'icon' =>  'fas fa-language',
                    
                ],
                [
                    'title' => 'Module',
                    'route' => 'generate.create',
                    'icon' => 'fas fa-brain',
                ],
                [
                    'title' => 'System Configuration',
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
//             'title' => 'Article',
//             'icon' => 'fa fa-file',
//             'name' => ['post'],
//             'subModule' => [
//                 [
//                     'title' => 'Article Group',
//                     'route' => 'post/catalogue/index'
//                 ],
//                 [
//                     'title' => 'Article',
//                     'route' => 'post/index'
//                 ]
//             ]
//         ],
//         [
//             'title' => 'User Group',
//             'icon' => 'fa fa-user',
//             'name' => ['user'],
//             'subModule' => [
//                 [
//                     'title' => 'User Group',
//                     'route' => 'user/catalogue/index'
//                 ],
//                 [
//                     'title' => 'User',
//                     'route' => 'user/index'
//                 ],
//                 [
//                     'title' => 'Permission',
//                     'route' => 'permission/index'
//                 ]
//             ]
//         ],
//         [
//             'title' => 'General',
//             'icon' => 'fa fa-file',
//             'name' => ['language'],
//             'subModule' => [
//                 [
//                     'title' => 'Language',
//                     'route' => 'language/index'
//                 ],
//             ]
//         ]
//     ],
// ];

