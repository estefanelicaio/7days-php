<?php

function authentication(string $email, string $password): void
{
    $users = crud_get_users();
    $auth_user = null;
    
    foreach($users as $user) {
        if($user['email'] === $email && $user['password'] === md5($password)) {
            $auth_user = $user;
        }
    }

    if($auth_user === null) {
        throw new DomainException("Email e/ou senha incorretos");
    }

    if($auth_user['mail_validation'] === false) {
        throw new DomainException("Usuário não verificou o email");
    }

    $_SESSION['user'] = json_encode($auth_user);

}

function auth_user(): stdClass|null
{
    return json_decode($_SESSION['user'] ?? ''); 
}