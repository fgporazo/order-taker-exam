<?php

function flashMessage($message, $success = true){
    session()->flash('msg', $message);
    if($success === true){
        session()->flash('msgClass', 'success');
    }else{
        session()->flash('msgClass', 'danger');
    }
}


function generateSKU($words){
    $acronym = "";
    foreach(explode(' ',$words) as $w) {
        if(preg_match('~[0-9]+~', $w)) {
            preg_match("/([0-9]+)/", $w, $matches);
            $acronym .= $matches[1];
         
        }else{
            $acronym .= mb_substr($w, 0, 1);
        }
    }
    return $acronym;
}