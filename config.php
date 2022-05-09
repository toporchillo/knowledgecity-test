<?php
// Microservice DB to store status history
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'mysql');
define('DB_DATABASE', 'test');
define('DB_PORT', '3306');

define('TOKEN_LIFETIME', 30*24*3600); //in seconds
define('PASSWORD_HASH_SALT', 'salty-random-string');

define('ROWS_PER_PAGE', 5);


define('MASTER_TOKEN', 'secret-token-to-create-user');
