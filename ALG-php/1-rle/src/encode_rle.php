<?php

function matches1($s) {
    return strlen($s[0]).$s[1];
}

// fonction encode_rle.
function encode_rle($str)
{
    // si $str == A-Z et a-z.
    if (ctype_alpha($str)){
        $input = $str;
        $pattern = '/(.)\1*/';
        return preg_replace_callback($pattern, 'matches1', $input);
    }
    // pour tout les autres cas ("a122a" "12443" " A 1BB " etc...).
    else{
        echo "$$$";
    }
}

?>