<?php

function crud_create($user): void
{
    $jsondata = file_get_contents(DATA_LOCATION);
    $arr_data = json_decode($jsondata, true);
    $arr_data[] =  $user;

    file_put_contents(DATA_LOCATION, json_encode($arr_data), LOCK_EX);
}