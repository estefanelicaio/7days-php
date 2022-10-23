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

    if($person['password'] === $person['password-confirm']) {
        unset($person['password-confirm']);
        crud_create($person);

        header("Location: /?page=login");
    } else {
        header("Location: /?page=register");
    }

}

function do_login(): void
{
    render_view('login');
}

function do_not_found(): void
{
    http_response_code(404);
    render_view('not_found');
}

