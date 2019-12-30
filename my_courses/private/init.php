<?php
ob_start(); // turn on output buffering

// Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

// Assign the root URL to a PHP constant
// * Do not need to include the domain
// * Use same document root as webserver
// * Can set a hardcoded value:
// define("WWW_ROOT", '/~kevinskoglund/chain_gang/public');
// define("WWW_ROOT", '');
// * Can dynamically find everything in URL up to "/public"
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

require_once('functions.php');
require_once('status_functions.php');
require_once('db_credits.php');
require_once('db_functions.php');
require_once('validation_functions.php');

// Load class definitions manually

// -> Individually
// require_once('classes/bicycle.class.php');

// -> All classes in directory 
// foreach()
foreach (glob('classes/*.class.php') as $file) {
  require_once($file);
}
// Autoload class definitions
function my_autoload($class_name)
{
  if (preg_match('/\A\w+\Z/', $class_name)) {
    include('classes/' . $class_name . '.class.php');
  }
}

spl_autoload_register('my_autoload');

$db = db_connect(); 
DbObj::set_database($db); 
$session = new Session; 