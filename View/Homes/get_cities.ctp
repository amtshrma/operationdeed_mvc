<?php
$str = '';
if(count($allCities) > 0){
    foreach($allCities as $key =>$city){ 
        $str .= '<option value="'.$key.'">'.$city.'</option>';   
    }   
}else{
    $str .= '<option value="">No City Available</option>';
}
echo $str;
?>