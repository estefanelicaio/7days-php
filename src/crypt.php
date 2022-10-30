<?php

function ssl_crypt(string $data)
{
    $open_ssl = openssl_encrypt(
        json_encode($data),
        'AES-128-CBC',
        SECRET,
        0,
        SECRET_IV
    );
    
    return base64_encode($open_ssl);
}

function ssl_decrypt(string $data)
{
    $open_ssl = openssl_decrypt(
        base64_decode($data),
        'AES-128-CBC',
        SECRET,
        0,
        SECRET_IV
    );
    
    return trim($open_ssl, '"');
}