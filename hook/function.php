<?php


function unicodeString($str, $encoding=null) {
    if (is_null($encoding)) $encoding = ini_get('mbstring.internal_encoding');
    return preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/u', function($match) use ($encoding) {
        return mb_convert_encoding(pack('H*', $match[1]), $encoding, 'UTF-16BE');
    }, $str);
}

function clean($str){
    $clean = unicodeString($var, 'UTF-8');
    $clean = str_replace(['Ã©','Ã¨'],['é','è'], $clean);
    return $clean;
}


/**
 * @param $var
 * @return bool
 */
function verifCivilite($var)
{
    if($var == 'Mme' or $var == 'Mlle' or $var == 'M.')
    {
        return true;
    }

    return false;
}

/**
 * @param $var
 * @return bool
 */
function verifStatut($var): bool
{

    $clean = unicodeString($var, 'UTF-8');
    $clean = str_replace(['Ã©','Ã¨'],['é','è'], $clean);
    if($clean == 'Salarie(e) du privé' or $clean == 'Salarie(e) du public' or $clean == 'Entreprise' or $clean == 'Autre')
    {
        return true;
    }

    return false;
}


function verifHoraire($var): bool
{
    $clean = unicodeString($var, 'UTF-8');
    $clean = str_replace(['Ã©','Ã¨'],['é','è'], $clean);
    if($clean == 'Avant 12 heures' or $clean == 'Entre 12 et 14 heures' or $clean == 'Entre 14 et 16 heures' or $clean == 'Après 16h' or $clean == 'Indifférent')
    {
        return true;
    }

    return false;
}

function Utf8_ansi($valor=''): string
{

    $utf8_ansi2 = array(
        "\u00c0" =>"À",
        "\u00c1" =>"Á",
        "\u00c2" =>"Â",
        "\u00c3" =>"Ã",
        "\u00c4" =>"Ä",
        "\u00c5" =>"Å",
        "\u00c6" =>"Æ",
        "\u00c7" =>"Ç",
        "\u00c8" =>"È",
        "\u00c9" =>"É",
        "\u00ca" =>"Ê",
        "\u00cb" =>"Ë",
        "\u00cc" =>"Ì",
        "\u00cd" =>"Í",
        "\u00ce" =>"Î",
        "\u00cf" =>"Ï",
        "\u00d1" =>"Ñ",
        "\u00d2" =>"Ò",
        "\u00d3" =>"Ó",
        "\u00d4" =>"Ô",
        "\u00d5" =>"Õ",
        "\u00d6" =>"Ö",
        "\u00d8" =>"Ø",
        "\u00d9" =>"Ù",
        "\u00da" =>"Ú",
        "\u00db" =>"Û",
        "\u00dc" =>"Ü",
        "\u00dd" =>"Ý",
        "\u00df" =>"ß",
        "\u00e0" =>"à",
        "\u00e1" =>"á",
        "\u00e2" =>"â",
        "\u00e3" =>"ã",
        "\u00e4" =>"ä",
        "\u00e5" =>"å",
        "\u00e6" =>"æ",
        "\u00e7" =>"ç",
        "\u00e8" =>"è",
        "\u00e9" =>"é",
        "\u00ea" =>"ê",
        "\u00eb" =>"ë",
        "\u00ec" =>"ì",
        "\u00ed" =>"í",
        "\u00ee" =>"î",
        "\u00ef" =>"ï",
        "\u00f0" =>"ð",
        "\u00f1" =>"ñ",
        "\u00f2" =>"ò",
        "\u00f3" =>"ó",
        "\u00f4" =>"ô",
        "\u00f5" =>"õ",
        "\u00f6" =>"ö",
        "\u00f8" =>"ø",
        "\u00f9" =>"ù",
        "\u00fa" =>"ú",
        "\u00fb" =>"û",
        "\u00fc" =>"ü",
        "\u00fd" =>"ý",
        "\u00ff" =>"ÿ");

    return strtr($valor, $utf8_ansi2);

}