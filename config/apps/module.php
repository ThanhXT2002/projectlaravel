<?php 
use Illuminate\Support\Facades\Route;
	return [
		'module' => [
            [
                'title' => 'QL Nhóm Bài Viết',
                'icon' => 'fas fa-pencil-ruler',
                'name' => 'post',
                'subModule' => [
                    [
                        'title' => 'QL bài viết',
                        'route' =>  'post.index',
                        'icon' =>  'fas fa-newspaper',
                        'label' => 'post',
                        
                        
                    ],
                    [
                        'title' => 'QL loại bài viết',
                        'route' =>  'post.catalogue.index',
                        'icon' =>  'fas fa-pen-square',
                        'label' => 'catalogue',
                    ],
                    
                ]
                
            ],
            [
                'title' => 'QL Tài Khoản',
                'icon' => 'fas fa-users-cog',
                'name' => 'user',
                'subModule' => [

                    [
                        'title' => 'QL thành viên',
                        'route' =>  'user.index',
                        'icon' =>  'fas fa-user',
                        'label' => 'user',
                    ],
                    [
                        'title' => 'QL nhóm  thành viên',
                        'route' =>  'user.catalogue.index',
                        'icon' =>  'fas fa-id-card',
                        'label' => 'catalogue',
                    ],
                ],
            ], 
            [
                'title' => 'Cấu hình chung',
                'icon' => 'fas fa-cogs',
                'name' => 'language',
                'subModule' => [

                    [
                        'title' => 'QL ngôn ngữ',
                        'route' =>  'language.index',
                        'icon' =>  'fas fa-language',
                        'label' => 'language',
                    ],
                
                ],
            ], 
    ]
];



