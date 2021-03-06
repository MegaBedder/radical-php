<?php
use Core\ErrorHandling\Handler;

include(__DIR__.'/../include/common.php');

if(!isset($argv[1])){
	die('No Daemon Specified'."\r\n");
}
$daemon = $argv[1];

//Get Arguments
$arguments = $argv;
unset($arguments[0],$arguments[1]);
$arguments = array_values($arguments);

//Do, and handle errors.
Handler::Handle(function() use($daemon,$arguments){
	$run = new CLI\Daemon\Runner($daemon);
	$run->Run($arguments);
});