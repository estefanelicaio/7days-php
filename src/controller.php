<?php


function do_register(): void
{
    // GET METHOD
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        render_view('register');
        exit();
    }

    // POST METHOD
    $person = $_POST['person'];

    $validation_errors = validate_register($person);

    if(count($validation_errors) === 0) {

        unset($person['password-confirm']);
        $person['mail_validation'] = false;
        $person['password'] = md5($person['password']);
        crud_create_user($person);

        send_mail(
            $person['email'],
            "Ativação de usuário no ScubaPHP",
            "Olá " . $person['name'] . ", para ativar seu usuário clique <a href=\"" . APP_URL . "?page=mail-validation&token=" . ssl_crypt($person['email']) ."\">aqui</a>"
        );


        $messages['success'] = ['register' => 'Seu cadastro foi realizado com sucesso! Para ativar o usuário será necessário confirmar o email.'];
        $_SESSION['messages'] = $messages;

        header("Location: /?page=login");
    } else {
        
        $messages['error'] = $validation_errors;
        $values = ['name' => $_POST['person']['name'], 'email' => $_POST['person']['email']];


        $_SESSION['messages'] = $messages;
        $_SESSION['values'] = $values;

        header("Location: /?page=register");
    }

}

function do_login(): void
{
    // GET METHOD
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        render_view('login');
        exit();
    }

    // POST METHOD
    $person = $_POST['person'];

    $messages = [];
    $_SESSION['messages'] = &$messages;

    try {
        authentication($person['email'], $person['password']);
        $messages['success'] = ['login' => 'Login realizado com sucesso!'];
        header("Location: /?page=home");

    } catch(Exception $e) {
        $messages['error'] = ['register' => $e->getMessage()];
        header("Location: /?page=login");
    }

}

function do_validation(): void
{
    $email = ssl_decrypt($_GET['token']);
    $user = crud_get_user_by_email($email);

    if($user) {
        $user['mail_validation'] = true;
        crud_update_user($user);
    
        $messages['success'] = ['register' => "Usuário " . $user['name'] . " ativado com sucesso!"];
    } else {
        $messages['error'] = ['register' => "Token inválido!"];
    }
    
    $_SESSION['messages'] = $messages;

    header("Location: /?page=login");
}

function do_home(): void
{
    render_view('home', (array) auth_user());
}

function do_logout(): void
{
    auth_logout();

    header("Location: /");
}

function do_delete_account(): void
{
    $authenticated_user = (array) auth_user();

    crud_delete_user($authenticated_user);
    auth_logout();

    header("Location: /");
}

function do_not_found(): void
{
    http_response_code(404);
    render_view('not_found');
}

