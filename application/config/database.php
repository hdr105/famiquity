<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'yacopo';
$query_builder = TRUE;

$db['yacopo'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	// 'username' => 'famiquity_usr',
	// 'password' => 'SB);}geRv[Fy',
	'username' => 'root',
	'password' => '',
	'database' => 'famiquity',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
