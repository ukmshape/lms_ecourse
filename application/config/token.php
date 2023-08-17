<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| application setting
| -------------------------------------------------------------------------
|
*/
if(ENVIRONMENT === 'production'){
$url_odl = "https://ecourse.ukm.my/lms/webservice/rest/server.php?";
	//$url_ukmfolio = "http://209.97.172.237/webservice/rest/server.php?";
	//$url_ukmfolio = "https://demo.ukmfolio.ukm.my/webservice/rest/server.php?"; //off by suzita 1/3/2022
}else{
	$url_odl = "https://ecourse.ukm.my/lms/webservice/rest/server.php?";
	//$url_ukmfolio = "http://209.97.172.237/webservice/rest/server.php?";
	//$url_ukmfolio = "https://demo.ukmfolio.ukm.my/webservice/rest/server.php?";//off by suzita 1/3/2022
}

// token pada server demo.ukm.folio
// $config = array(
// 	'url_ukmfolio' => $url_ukmfolio,
// 	//'group_token' => 'db9379e482095de92bef22e7984e0d6e',
// 	'create_group_token' => '1dd75239bc5e3f8e90abab156cbe2640',//core_group_create_groups,core_group_assign_grouping guna token yang sama
// 	'get_user_token' => '25e8e62f517ef173b511b7f6b022393a',
// 	'create_user_token' => '24092b2dea8055827e1d4402719e1af3',
// 	'create_courses_token' => '1646f5fe98cd136ef04a3743217d7501',
// 	'get_categoryid_token' => 'db9379e482095de92bef22e7984e0d6e', //core_course_get_courses_by_field guna token yang sama
// 	'manual_enrol_token' => '28524abdd8142f8ddb43681956abc577',
// 	'manual_unenrol_token' => 'b81eab4c0f1274fc013c249d92ef8282',
// 	'get_userid_token' => '25e8e62f517ef173b511b7f6b022393a',
// 	'get_courseid_token' => 'db9379e482095de92bef22e7984e0d6e',
// 	'add_user_to_group_token' => '1dd75239bc5e3f8e90abab156cbe2640',
// 	'sem' => '2',
// 	'sesi' => '20192020'
// );

// token pada server cloud ukmfolio http://209.97.172.237/
// $config = array(
// 	'url_ukmfolio' => $url_ukmfolio,
// 	'create_group_token' => '2fd3fc2a4def27a7ab42b514bc2466f0',//core_group_create_groups,core_group_assign_grouping guna token yang sama
// 	'get_user_token' => '81ce3559e37ed8c337ab8bd5f9762546',
// 	'create_user_token' => '369ad62173dcca88e905b1d8f5806ca1',
// 	'create_courses_token' => 'f0b92eda301866ed7384d7b7e3b34c7b',
// 	'get_categoryid_token' => '9d539994b1e78b72300eedcfd5a1b0cb', //core_course_get_courses_by_field guna token yang sama
// 	'manual_enrol_token' => '6863b73e24db72b68d4db2cbd7cba467',
// 	'manual_unenrol_token' => '0d1deebec36917cb45b5267b593dd319',
// 	'get_userid_token' => '81ce3559e37ed8c337ab8bd5f9762546',
// 	'get_courseid_token' => '9d539994b1e78b72300eedcfd5a1b0cb',
// 	'add_user_to_group_token' => '2fd3fc2a4def27a7ab42b514bc2466f0',
// 	'remove_user_from_group_token' => '827d849af4e0ac4c49d826af53f48289',//delete_group_members_token
// 	'delete_group_token' => '4f90b08dce1ce46748c1d745951d53a9',
// 	'delete_grouping_token' => '3b9f087dfd80c6f4107f867084e1f039',
// 	'sem' => '1',
// 	'sesi' => '20212022'
// 	// 'sem' => '1',
// 	// 'sesi' => '20202021'
// );



//token pada server develop demo.ukm.folio -- 1/3/2022 by suzita

//dev
// $config = array(
// 	'url_odl' => $url_odl,
// 	'get_user_token' => '1c57f7da7302de2a130c70bb204af03a', // core_user_get_users
// 	'create_user_token' => 'ebcb37d86237af94dc502a01c61d82e6', // core_user_create_users
// 	'manual_enrol_token' => '8c66ce03630b5b7f67c5da70be3b299c', // enrol_manual_enrol_users
// 	'manual_unenrol_token' => '90754a2d6ed3425604d174f0b391f7ea', // enrol_manual_unenrol_users
// 	'get_userid_token' => '1c57f7da7302de2a130c70bb204af03a', // core_user_get_users
// 	'get_courseid_token' => 'b9acd7ca4c3343d8ff13e047a77fe04c'
// );

//prod
$config = array(
	'url_odl' => $url_odl,
	'get_user_token' => '875d66941dd4f1240cae8a9921869aba', // core_user_get_users
	'create_user_token' => '9c4c6ab696203a3d61790fff0082492c', // core_user_create_users
	'manual_enrol_token' => '2badac9a0cc6eed8ff6aacf5e54d85c0', // enrol_manual_enrol_users
	'manual_unenrol_token' => 'f0d5283162bfa7f64631ec386154cede', // enrol_manual_unenrol_users
	'get_userid_token' => '875d66941dd4f1240cae8a9921869aba', // core_user_get_users
	'get_courseid_token' => '06cf9c882ed25dff4bfe7bd6b634a691',
	'update_user_token' => 'b74169d441bc76e18074b665cf12e73d'
);


//token pada server produk ukmfolio https://ukmfolio.ukm.my/

// $config = array(
// 	'url_ukmfolio' => $url_ukmfolio,
// 	'create_group_token' => '85fa518b7d04046f647d40c8f1840c89', // core_group_create_groups,core_group_create_groupings,core_group_assign_grouping,core_group_add_group_members
// 	'get_user_token' => '5eeda2d69160a7791bb85a8460179cf4', // core_user_get_users
// 	'create_user_token' => '532ba0655ea47e9c156ebc46419e8a02', // core_user_create_users
// 	'create_courses_token' => '4a4ba44a645531915af87497c18ae15c',// core_course_create_courses
// 	'get_categoryid_token' => '60976db8569b46005210c61d583aaf34', // core_course_get_categories, core_course_get_courses_by_field
// 	'manual_enrol_token' => 'c98a4f37ccf049bea470ca24cd8dcca0', // enrol_manual_enrol_users
// 	'manual_unenrol_token' => '6d97e345282b9d20496a641ad9ad9f2c', // enrol_manual_unenrol_users
// 	'get_userid_token' => '5eeda2d69160a7791bb85a8460179cf4', // core_user_get_users
// 	'get_courseid_token' => '60976db8569b46005210c61d583aaf34',
// 	'add_user_to_group_token' => '85fa518b7d04046f647d40c8f1840c89',
// 'remove_user_from_group_token' => '6ccbc72f80aa263c5f65b2f25721d2ff ',
// 	'sem' => '2',
// 	'sesi' => '20192020'
// );
