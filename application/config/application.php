<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| application setting
| -------------------------------------------------------------------------
|
*/

$config = array(
	// remove ci 3.1.3
	//'language' => 'malay',
	'application' =>
		array(
			'name'=>
				array(
					'malay'=>'Template CI',
					'english'=>'CI Template'),
			'about'=>
				array(
					'malay'=>'Malay-Lorem ipsum dolor sit amet, nam probo vivendo imperdiet ad. Aperiam euismod cum eu, usu ad iisque inimicus.',
					'english'=>'English-Lorem ipsum dolor sit amet, nam probo vivendo imperdiet ad. Aperiam euismod cum eu, usu ad iisque inimicus.')),
	'kodsistem' => 'ISTAR',
	'kodMenu' => 323, //306-ICGPA, 279-MENUAPPS, 314-CI
	'dbmenu' => 'ecourse',
	'kelasteknikal' => 'CI',
	'profiler_ips'=>array(
		'10.1.133.79',
		'10.1.128.126'

		)

);
