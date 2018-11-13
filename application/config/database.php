<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'yacopo';
$query_builder = TRUE;

$db['yacopo'] = array(
	'dsn'	=> '',
	// 'hostname' => 'localhost',
	// 'username' => 'famiquity_usr',
	// 'password' => 'SB);}geRv[Fy',
	// 'hostname' => 'shareddb1e.hosting.stackcp.net',
	// 'username' => 'famiquity-363715db',
	// 'password' => 'famiquity123',
	// 'database' => 'famiquity-363715db',

	'hostname' => 'localhost',
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
