<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'ecourse';
$query_builder = TRUE;

$db['pdata'] = array(
    'dsn'	=> '',
    'hostname' => 'database-ukmshape.cj3gorfkfzca.ap-southeast-1.rds.amazonaws.com',
    'port' => 3306,
    'username' => 'admin',
    'password' => 'ukmshapeUKMAWS',
    'database' => 'ecourse',
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

$db['ecourse'] = array(
    'dsn'	=> '',
    'hostname' => 'database-ukmshape.cj3gorfkfzca.ap-southeast-1.rds.amazonaws.com',
    'port' => 3306,
    'username' => 'admin',
    'password' => 'ukmshapeUKMAWS',
    'database' => 'ecourse',
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

$db['mcodlukm'] = array(
    'dsn'	=> '',
    'hostname' => '54.179.149.47',
    'port' => 3306,
    'username' => 'root',
    'password' => 'ukmAWSEC2WindowsUKMSHAPE',
    'database' => 'mcodlukm',
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
