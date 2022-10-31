<?php
function formatearFecha($fecha)
{
    return date('d M, Y, g:i a', strtotime($fecha));
}

function textoCorto($texto, $chars = 50)
{
    $texto = $texto . "";
    $texto = substr($texto, 0, $chars);
    $texto = substr($texto, 0, strrpos($texto, ''));
    $texto = $texto . "...";
    return $texto;
}
