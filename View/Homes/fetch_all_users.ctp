<?php
$str = '';
if(count($allUsers) > 0){
    foreach($allUsers as $key =>$user){ 
        $str .= '<option value="'.$key.'">'.$user.'</option>';   
    }   
}else{
    $str .= '<option value="">No User Available</option>';
}
echo $str;
?>