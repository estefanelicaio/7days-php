<?php

function crud_create_user(array $user): void
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

function crud_update_user(array $updated_user): void
{
    $users = crud_get_users();

    $updated_users = array_map(fn($user) => $user['email'] === $updated_user['email'] ? $updated_user : $user, $users);

    file_put_contents(DATA_LOCATION, json_encode($updated_users), LOCK_EX);
}

function crud_delete_user(array $deleted_user): void
{
    $users = crud_get_users();

    $users = array_values(array_filter($users, fn($user) => $user['email'] !== $deleted_user['email']));

    file_put_contents(DATA_LOCATION, json_encode($users), LOCK_EX);
}

function crud_get_user_by_email(string $email): array|null
{
    $users = crud_get_users();

    foreach($users as $user) {
        if($user['email'] === $email) {
            return $user;
        }
    }

    return null;
}