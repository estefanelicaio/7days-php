<?php
define('SLASH',DIRECTORY_SEPARATOR);
define('VIEW_FOLDER',__DIR__.SLASH.'view'.SLASH);
define('DATA_LOCATION',__DIR__.SLASH.'data'.SLASH.'users.json');

define('APP_URL','http://localhost:8000');
define('APP_NAME','ScubaPHP');

define('SECRET', pack('a16','senha'));
define('SECRET_IV', pack('a16','senha'));

define('SMTP_HOST', 'smtp.mailtrap.io');
define('SMTP_PORT', '587');
define('SMTP_USER', '258fc4ed2e37fa');
define('SMTP_PASSWORD', 'ce9a6172d49c39');

define('EMAIL_ADDRESS','scubaphp@email.com');