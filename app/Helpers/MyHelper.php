<?php

if(!function_exists('convert_price')){
    function convert_price(string $price = ''){
        return str_replace('.','', $price);
    }
}

// chuyển về mảng 1 chiều
if (!function_exists('convert_array')) {
    function convert_array($system = null, $keyword = '', $value = '') {
        $temp = [];
        if (is_array($system)) {
            foreach ($system as $key => $val) {
                if (isset($val[$keyword]) && isset($val[$value])) {
                    $temp[$val[$keyword]] = $val[$value];
                }
            }
        }

        if (is_object($system)) {
            foreach ($system as $key => $val) {
                if (isset($val->{$keyword}) && isset($val->{$value})) {
                    $temp[$val->{$keyword}] = $val->{$value};
                }
            }
        }

        return $temp; // Trả về kết quả cuối cùng
    }
}



if(!function_exists('renderSystemInput')){
    function renderSystemInput(string $name = '', $system = null){
        return '<input type="text" 
                name="config['.$name.']"
                value="'.old($name, ($system[$name]) ?? '').'"
                class="form-control form-control-sm rounded-0 shadow border border-info"
                placeholder="" 
                autocomplete="off">';
    }
}

if(!function_exists('renderSystemImages')){
    function renderSystemImages(string $name = '', $system = null){
        return '<input type="text" 
                name="config['.$name.']"
                value="'.old($name, ($system[$name]) ?? '').'"
                class="form-control form-control-sm rounded-0 shadow border border-info upload-image"
                placeholder="" 
                autocomplete="off">';
    }
}

if(!function_exists('renderSystemTextArea')){
    function renderSystemTextArea(string $name = '', $system = null){
        return '<textarea type="text" 
                name="config['.$name.']"
                class="form-control  rounded-0 shadow border border-info"
                style=" height:200px !important"
                >'.old($name, ($system[$name]) ?? '').'</textarea>';
    }
}

if(!function_exists('renderSystemEditor')){
    function renderSystemEditor(string $name = '', $system = null){
        return '<textarea type="text" 
                name="config['.$name.']"
                id="'.$name.'"
                class="form-control  rounded-0 shadow border border-info ck-editor"
                data-height="500"
                >'.old($name, ($system[$name]) ?? '').'</textarea>';
    }
}

if (!function_exists('renderSystemLink')) {
    function renderSystemLink(array $item = []) {
        return (isset($item['link'])) ? '<a href="'.$item['link']['href'].'" target="blank">'.$item['link']['text'].'</a>' : '' ;
    }
}

if (!function_exists('renderSystemTitle')) {
    function renderSystemTitle(array $item = []) {
        return (isset($item['title'])) ? '<i class="text-danger">'.$item['title'].'</i>' : '' ;
    }
}

if (!function_exists('renderSystemSelect')) {
    function renderSystemSelect(array $item, string $name = '', $system = null) {
        $html = '<select name="config[' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . ']" class="form-control form-control-sm rounded-0 shadow border border-info">';
        
        foreach ($item['option'] as $key => $val) {
            $selected = (isset($system[$name]) && $key == $system[$name]) ? 'selected' : '';
            $html .= '<option value="' . htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . '" ' . $selected . '>' . htmlspecialchars($val, ENT_QUOTES, 'UTF-8') . '</option>';
        }

        $html .= '</select>';

        return $html;
    }
}
