<?php

function crud_create_user($user): void
{
    $arr_data = crud_get_users();
    $arr_data[] =  $user;

    file_put_contents(DATA_LOCATION, json_encode($arr_data), LOCK_EX);
}

function crud_get_users(): array
{
    $jsondata = file_get_contents(DATA_LOCATION);

    return json_decode($jsondata, true);
}