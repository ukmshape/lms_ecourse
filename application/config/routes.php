<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['test'] = 'test/index'; 
$route['test/hello'] = 'test/hello';



$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//$route['default_controller'] = "dash";
$route['main'] = $route['default_controller'];
//$route['default_controller'] = "dash/index";

$route['main/index/(:num)'] = 'main/index';
$route['main/index/(:any)/(:num)'] = 'main/index';
$route['main/index/(:any)/(:any)/(:num)'] = 'main/index';
$route['main/index/(:any)/(:any)/(:any)/(:num)'] = 'main/index';


$route['main/index/(:any)'] = 'main/index';
$route['main/index/(:any)/(:any)'] = 'main/index';
$route['main/index/(:any)/(:any)/(:any)'] = 'main/index';


//$route['main/carts/'] = 'main/carts';
$route['MC/carts/personaldetail'] = 'MC/carts_next_1';
$route['MC/carts/payment'] = 'MC/payment';
$route['MC/carts/add_cart'] = 'MC/checkout_PO';
$route['MC/carts/checkout'] = 'MC/carts_next_1';
$route['MC/carts/complete'] = 'MC/complete';
$route['MC/carts/done'] = 'MC/complete_0';
$route['carts'] = 'MC/carts';

$route['SP/carts/personaldetail'] = 'SP/carts_next_1';
$route['SP/carts/checkout'] = 'SP/checkout_PO';
$route['SP/carts/payment'] = 'SP/payment';
$route['SP/carts/complete'] = 'SP/complete';
$route['SP/carts/done'] = 'SP/complete_fakulti';

$route['dashboard/auth'] = "dashboard/auth_proses";
//auth
//-------------------------------------------------------------------------------
/*signin-from sso*/
/*
$route['signin'] = "auth/signin";
$route['(.+)/signin'] = "auth/signin";
$route['signin/(.+)'] = "auth/signin";
//login
$route['login'] = "auth/login";
$route['(.+)/login'] = "auth/login";
$route['login/(.+)'] = "auth/login";
//logout
$route['logout'] = "auth/logout";
$route['(.+)/logout'] = "auth/logout";
$route['logout/(.+)'] = "auth/logout";
//relogin
$route['relogin'] = "auth/relogin";
$route['(.+)/relogin'] = "auth/relogin";
$route['relogin/(.+)'] = "auth/relogin";
//loginfail
$route['loginfail'] = "auth/loginfail";
$route['(.+)/loginfail'] = "auth/loginfail";
$route['loginfail/(.+)'] = "auth/loginfail";
//logoutfail
$route['logoutfail'] = "auth/logoutfail";
$route['(.+)/logoutfail'] = "auth/logoutfail";
$route['logoutfail/(.+)'] = "auth/logoutfail";
//loggedout
$route['loggedout'] = "auth/loggedout";
$route['(.+)/loggedout'] = "auth/loggedout";
$route['loggedout/(.+)'] = "auth/loggedout";
//notuser
$route['notuser'] = "auth/notuser";
$route['(.+)/notuser'] = "auth/notuser";
$route['notuser/(.+)'] = "auth/notuser";
*/
//-------------------------------------------------------------------------------
