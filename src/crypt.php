<?php

function ssl_crypt(string $data)
{
    return openssl_encrypt(
        $data,
        'AES-128-CBC',
        SECRET,
        0,
        SECRET_IV
    );
}

function ssl_decrypt(string $data)
{
    return openssl_decrypt(
        $data,
        'AES-128-CBC',
        SECRET,
        0,
        SECRET_IV
    );
}