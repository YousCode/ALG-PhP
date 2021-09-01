<?php

include 'src/decode_rle.php';
include 'src/encode_rle.php';

//si l'argument 2 est vide, alors j'annule le programme.
if(empty($argv[2])){
    exit;
}
//$str sera égale a l'entrée utilisateur du 2ème argument.
$str = $argv[2];

//si l'argument 1 est "encode", il va lancé la fonction encode_rle.
if ($argv[1] == "encode"){
    // si il y a un 3eme argument (donc un espace) $str = 0 donc va afficher $$$.
    if (!empty($argv[3])) {
        $str = 0;
    }
    // affiche le résultat de la fonction encode_rle, suivi d'un retour a la ligne (PHP_EOL).
    echo encode_rle($str), PHP_EOL;
}
//
elseif ($argv[1] == "decode"){
    // si il y a un 3eme argument (donc un espace) ou si dans le str a decodé il y a une suite de ce type la (Ab, dP, SD, bn etc...) $str = 0 donc va afficher $$$.
    if (!empty($argv[3]) || preg_match('/[A-z][A-z]/',$str) || preg_match('/[0-9]$/',$str)) {
        $str = 0;
    }
    // affiche le résultat de la fonction decode_rle, suivi d'un retour a la ligne (PHP_EOL).
    echo decode_rle($str), PHP_EOL;
}

else{
    echo "$$$\n";
}
?>