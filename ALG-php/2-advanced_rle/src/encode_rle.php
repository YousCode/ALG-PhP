<?php


function marray(string $str) {
    $str = str_replace(' ', '', $str);
    $str = str_replace("\n", '', $str);
    $array = str_split($str, 1);

    array_push($array, "0", "0");

    return $array;
}

function suite(array $array) {
    $i = 0;
    $lenth = count($array);

    while ($i < $lenth && $array[$i] != $array[$i+1]) {
        $i++;
    }

    return $i;
}

function checkerr(string $input_path)
{
    if (!file_exists($input_path)) {
        echo "KO\n";
        return (1);
    }

    $str = file_get_contents($input_path);

    if (!is_string($str)) {
        echo "KO\n";
        return (1);  
    }
    
    return (0);
}

function rev_int($nb) {
    $swap = 0;

    while ($nb > 0) {
        $swap = $swap * 10;
        $swap = $swap + $nb % 10;
        $nb = (int)($nb/10);
    }
    
    return $swap;
}  

function dectoHex($nb) {
    $rem = '';

    while ($nb > 0) {
        $rem .= intval($nb) % 16;
        $nb = intval($nb) / 16;
    }

    if ($rem)
        $nb = $rem;
        
    return rev_int($nb);
}

function encode_advanced_rle(string $input_path, string $output_path) {
    if (checkerr($input_path)) {
        echo "KO\n";
        return 1;
    }

    $str = file_get_contents($input_path);
    $array = marray($str);
    $lenth = count($array);
    $i = 0;
    $a = 0;
    $prec = '';
    $result = '';

    if ($lenth != 3 && $str) {
        while ($i < $lenth) {
            if ($prec == '')
                $prec = $array[$i];

            if ($array[$i] == $prec)
                $a++;
            else if ($a >= 2 && $a <= 255) {
                $result = "$result".chr($a)."$prec";
                $prec = $array[$i];
                $a = 1;
            } else if ($a > 255) {
                $b = $a - (255 * intval(($a / 255)));
                
                for ($c = 0; $c < intval(($a / 255)); $c++)
                    $result = "$result".chr(255)."$prec";

                $result = "$result".chr($b)."$prec";
                $prec = $array[$i];
                $a = 1;
            } else {
                $i--;
                $diff = suite(array_slice($array, $i));
                $result = "$result".chr(0).chr($diff);

                $diff += $i;

                while ($i < $diff) {
                    $result = "$result"."$array[$i]";
                    $i++;
                }

                $a = 1;
                $prec = $array[$i];
            }

            $i++;
        }
    } else {
        if ($str) {
            $result = chr(0).chr(1).$array[0];
        } else
            $result = '';
    }

    echo "OK\n";
    file_put_contents($output_path, $result);
    return 0;
}

?>