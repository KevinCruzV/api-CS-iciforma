<?php

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
function verifStatut($var)
{
    if($var == 'Salarie(e) du privé' or $var == 'Salarie(e) du public' or $var == 'Entreprise' or $var == 'Autre')
    {
        return true;
    }

    return false;
}


function verifHoraire($var)
{
    if($var == 'Avant 12 heures' or $var == 'Entre 12 et 14 heures' or $var == 'Entre 14 et 16 heures' or $var == 'Après 16h' or $var == 'Indifférent')
    {
        return true;
    }

    return false;
}