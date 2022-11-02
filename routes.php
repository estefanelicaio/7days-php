<?php

function auth_routes(): void
{
    $page = $_GET['page'] ?? 'login';
    switch($page) {
        case "home":
            do_home();
            break;
        case "logout":
            do_logout();
            break;
        case "delete-account":
            do_delete_account();
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
        case "forget-password":
            do_forget_password();
            break;
        case "change-password":
            do_change_password();
            break;
        default:
            do_not_found();
    }
}