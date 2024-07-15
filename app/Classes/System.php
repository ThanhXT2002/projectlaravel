<?php
namespace App\Classes;

class System{
    public function config(){
        $data['homepage'] = [
            'label' =>'Thông tin chung',
            'description'=>'Cài đặt đầy đủ thông tin chung của website, Tên thương hiệu website, Logo, Favicon, vv',
            'value' => [
                'company' =>['type'=>'text' , 'label'=>'Tên công ty'],
                'brand' =>['type'=>'text' , 'label'=>'Tên thương hiệu'],
                'slogan' =>['type'=>'text' , 'label'=>'slogan'],
                'logo' =>['type'=>'images' , 'label'=>'Logo Website', 'title' =>'Click vào ô phía dưới để tải logo'],
                'Favicon' =>['type'=>'images' , 'label'=>'Favicon', 'title' =>'Click vào ô phía dưới để tải logo'],
                'Images' =>['type'=>'images' , 'label'=>'Images', 'title' =>'Click vào ô phía dưới để tải logo'],
                'copyright' =>['type'=>'text' , 'label'=>'Copyright'],
                'website' =>[
                    'type'=>'select' ,
                    'label'=>'Tính trạng website',
                    'option'=>[
                        'open' =>'Mở cửa website',
                        'close' => 'Website đang bảo trì'
                    ]
                ],
                

            ]

        ];

        $data['contact'] = [
            'label' =>'Thông tin liên hệ',
            'description'=>'Cài đặt thông tin liên hệ của website ví dụ: Địa chỉ công ty, Văn phòng giao dịch, Hotline, Bản đò, vv....',
            'value' => [
                'office' =>['type'=>'text' , 'label'=>'Địa chỉ công ty'],
                'address' =>['type'=>'text' , 'label'=>'Văn phòng giao dịch'],
                'hotline' =>['type'=>'text' , 'label'=>'hotline'],
                'teachnical_phone' =>['type'=>'text' , 'label'=>'hotline kỹ thuật'],
                'sell_phone' =>['type'=>'text' , 'label'=>'Hotline kính doanh'],
                'phone' =>['type'=>'text' , 'label'=>'Số cố định'],
                'fax' =>['type'=>'text' , 'label'=>'Fax'],
                'email' =>['type'=>'text' , 'label'=>'Email'],
                'tax' =>['type'=>'text' , 'label'=>'Mã số thuế'],
                'website' =>['type'=>'text' , 'label'=>'Website'],
                'map' =>[
                    'type'=>'textarea' , 
                    'label'=>'Bản đồ',
                    'link' =>[
                        'text'=>'Hướng dẫn thiết lập lấy bản đồ',
                        'href'=>'https://manhan.vn/hoc-website-nang-cao/huong-dan-nhung-ban-do-vao-website/'
                    ]
                ],
                'short_intro' =>['type'=>'editor', 'label'=>'Giới thiệu ngắn']
                
               
            ]

        ];

        $data['seo'] = [
            'label' =>'Cấu hình SEO',
            'description'=>'Cài đặt đầy đủ thông tin về SEO của trang chủ website, Bao gồm tiêu đề SEO, Từ khóa SEO, Mô tả SEO, Meta images',
            'value' => [
                'meta_title' =>['type'=>'text' , 'label'=>'Tiêu đề SEO'],
                'meta_keyword' =>['type'=>'text' , 'label'=>'Từ khóa SEO'],
                'meta_description' =>['type'=>'textarea' , 'label'=>'Mô tả SEO'],
                'meta_images' =>['type'=>'images' , 'label'=>'Ảnh SEO'],
            ]

        ];

        return $data;
    }
}