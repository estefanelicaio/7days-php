<?php

function validate_register($person): array
{
    $errors_messages = [];

    if(strlen($person['password']) < 10) {
        $errors_messages['password'] = 'A senha não pode ser inferior a 10 caracteres';
    }

    if($person['password'] !== $person['password-confirm']) {
        $errors_messages['password-confirm'] = 'As senhas devem ser iguais';
    }

    $users = crud_get_users();

    foreach($users as $user) {
        if($user['email'] === $person['email']) {
            $errors_messages['email'] = 'Já existe um usuário cadastrado com este email';
            break;
        }
    }

    return $errors_messages;
}