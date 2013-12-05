<?php

// Error Reporting, disable if live
error_reporting(E_ALL);

// Disable magic quotes
ini_set('magic_quotes_gpc', 0); 
ini_set('magic_quotes_runtime', 0); 
ini_set('magic_quotes_sybase', 0);

// Misc
$language = 'nl';

// Set exceptions/redirects and new destination
$exceptions = array(
  // leave out '/' before both strings, example: 'contact.html' => 'contact/'
);

// Default or 'home' page
$defaultPage = 'index.php';

// Headers
$title = 'Wordgame';
$desc = 'A wordgame using SQL and PHP for Server Side Scripting';
$author = 'Frank Kalk';
$client = 'HVA';
$copyright = '(c) ' . date('Y') . ' Frank @ burningafro.org';

// SQL
define('MYSQL_HOST', 'db_host');
define('MYSQL_USER', 'db_user');
define('MYSQL_PASS', 'db_pass');
define('MYSQL_DB', 'db_name');
define('BASE_URL', 'base url for this site');
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

?>