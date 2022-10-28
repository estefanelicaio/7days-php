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
        crud_create_user($person);

        send_mail(
            $person['email'],
            "Ativação de usuário no ScubaPHP",
            "Olá " . $person['name'] . ", para ativar seu usuário clique <a href=\"" . APP_URL . "?page=mail-validation&token=" . ssl_crypt($person['email']) ."\">aqui</a>"
        );

        session_start();
        $messages['success'] = ['register' => 'Seu cadastro foi realizado com sucesso! Para ativar o usuário será necessário confirmar o email.'];
        $_SESSION['messages'] = $messages;

        header("Location: /?page=login");
    } else {
        
        $messages['error'] = $validation_errors;
        $values = ['name' => $_POST['person']['name'], 'email' => $_POST['person']['email']];

        session_start();
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
}

function do_validation(): void
{
    $email = ssl_decrypt($_GET['token']);
    $user = crud_get_user_by_email($email);

    var_dump($user);
}

function do_not_found(): void
{
    http_response_code(404);
    render_view('not_found');
}

