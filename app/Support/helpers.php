<?php

if (!function_exists('encryption_secret')) {
    function encryption_secret($recycleServiceId, $invoiceYear, $invoiceMonth,
            $invoiceStartDate, $invoiceEndDate, $outputDate)
    {
        return sha1($recycleServiceId . $invoiceYear . $invoiceMonth
                . $invoiceStartDate . $invoiceEndDate . $outputDate);
    }
}

if (!function_exists('convertToSlug')) {

    function convertToSlug($str) 
    { 
        if(!$str) return false; 
         
        $str = str_replace(', ', ',', $str); 
        $str = str_replace('-', '', $str); 
        $str = trim($str); 

        $unicode = array( 
        'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ', 
                'Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ'), 
        'd'=>array('đ', 'Đ'), 
        'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ', 
                'É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','Ể','Ễ','Ệ'), 
        'i'=>array('í','ì','ỉ','ĩ','ị', 'Í','Ì','Ỉ','Ĩ','Ị'), 
        'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ', 
                'Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','Ợ'), 
        'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự', 
                'Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ','Ử','Ữ','Ự'), 
        'y'=>array('ý','ỳ','ỷ','ỹ','ỵ','Ý','Ỳ','Ỷ','Ỹ','Ỵ'), 
        ''=>array('`', '~', '!', '#', '$', '%', '^', '&', '(',')', '=', '[', ']', '*', 
                '{', '}', ';', ':', '\'', '"', '<', '>', '|'), 
        '-'=>array('\\', ','), 
        '+'=>array('/') 
        ); 
        foreach($unicode as $nonUnicode=>$uni) 
        { 
        foreach($uni as $value) 
        $str = str_replace($value,$nonUnicode,$str); 
        } 
        $str = str_replace(' ', '-', $str); 
        $str = str_replace('--', '-', $str); 
        $str = strtolower($str); 

        return $str; 
    } 

}
if (!function_exists('convertNumber')) {
    function convertNumber($so)
    {
        if($so !=0) $re = number_format($so,0,".",".");
        else $re = 0;
        return $re;
    }
}

if (!function_exists('objectToArray')) {
    function objectToArray($data)
    {
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = get_object_vars($value);
            }
            return $result;
        }
        return $data;
    }
}








?>
