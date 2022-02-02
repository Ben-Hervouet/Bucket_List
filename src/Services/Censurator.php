<?php


namespace App\Services;


use phpDocumentor\Reflection\Types\Self_;

class Censurator
{
        const MOTS_INTERDITS = ["putin", "enculer", "pute", "con", "connard"];
    public function purify($texte){


        //$replace = array('putin', 'enculer', 'pute', 'con');
        //$change = array('cat', 'dog', 'fille', 'bonobo');

        foreach (self::MOTS_INTERDITS as $motInterdit){
            $remplacement = str_repeat("*", mb_strlen($motInterdit));
            $texte = str_ireplace($motInterdit,$remplacement,$texte);
        }

            return $texte;
        //return str_replace($replace, $change, $text);
    }

}