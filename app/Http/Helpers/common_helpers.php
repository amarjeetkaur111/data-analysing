<?php
use Illuminate\Support\Arr;
function get_d($data)
{
    echo "<pre>";
    print_r($data);
    die();
}

function get($data)
{
    echo "<pre>";
    print_r($data);
}

function encval($id)
{
     $Requri = $_SERVER['HTTP_HOST'];
     if(is_numeric(strpos($Requri, '127.0.0.1')))
     {
         return $id;
     }else
     {
        $enc = encrypt($id);
        return $enc;
     }
}

function decval($id)
{
     $Requri = $_SERVER['HTTP_HOST'];
     if(is_numeric(strpos($Requri, '127.0.0.1')))
     {
         return $id;
     }else
     {
        $dec = decrypt($id);
        return $dec;
     }
}

?>