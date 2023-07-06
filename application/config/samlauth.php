<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| samlauth
| -------------------------------------------------------------------
| Fail ini menyimpan pembolehubah atau tetapan keseluruhan sistem
|
*/
// kodsistem
/*
|	kosongkan untuk guna $config['kodsistem'] dalam config/application.php
*/
$config['sso.kodsistem'] = null;
//fail autoload simplesaml
$config['sso.autoload'] = '/var/www/html/smk/simplesaml/lib/_autoload.php';
//authentication source used
$config['sso.authsrc'] = 'smuSSO-sp';
$config['sso.dbpdata'] = 'ecourse';
