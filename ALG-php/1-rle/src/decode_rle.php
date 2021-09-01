<?php

function matches2($s) {
    return str_repeat($s[2], $s[1]);
}

// fonction decode_rle.
function decode_rle($str)
{
    // si $str = suite de chiffre et de lettre et que son pattern est correct (4A3B2C1D).
    if (ctype_alnum($str) && preg_match('/(\d+)(\D)/',$str)){
        $input = $str;
        $pattern = '/(\d+)(\D)/';
        return preg_replace_callback($pattern, 'matches2', $input);
    }
    // pour tout les autre cas (aaa, 111 etc...).
    else{
        echo "$$$";
    }
}

?>