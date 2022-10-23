<?php


function do_register(): void
{
    render_view('register');
}

function do_login(): void
{
    render_view('login');
}

function do_not_found(): int
{
    return http_response_code(404);
}

