<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
// $route['default_controller'] = 'welcome';
$route['default_controller'] = 'C_auth/index';
$route['login'] = 'C_auth/login';
$route['logout'] = 'C_auth/logout';

$route['beranda'] = 'C_beranda/index';

$route['upload_indikator'] = 'C_uploadIndikator/index';

$route['indikator'] = 'C_indikator/index';
$route['data_bps'] = 'C_indikator/data_bps';
$route['detail_data'] = 'C_indikator/detail_data';

$route['fitur'] = 'C_fitur/index';
$route['tambah_fitur'] = 'C_fitur/tambah_fitur';
$route['hapus_fitur'] = 'C_fitur/hapus_fitur';
$route['edit_fitur/(:num)'] = 'C_fitur/edit_fitur/$1';

$route['user'] = 'C_user/index';
$route['tambah_user'] = 'C_user/tambah_user';
$route['hapus_user'] = 'C_user/hapus_user';
$route['edit_user/(:num)'] = 'C_user/edit_user/$1';

$route['role'] = 'C_role/index';
$route['tambah_role'] = 'C_role/tambah_role';
$route['update_role'] = 'C_role/update_role';
$route['hapus_role'] = 'C_role/hapus_role';
$route['edit_role/(:num)'] = 'C_role/edit_role/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
