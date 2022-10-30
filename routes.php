<?php

function auth_routes(): void
{
    $page = $_GET['page'] ?? 'login';
    switch($page) {
        case "home":
            do_home();
            break;
        default:
            do_not_found();
    }
}

function guest_routes(): void
{
    $page = $_GET['page'] ?? 'login';

    switch($page) {
        case "register":
            do_register();
            break;
        case "login":
            do_login();
            break;
        case "mail-validation":
            do_validation();
            break;
        default:
            do_not_found();
    }
}