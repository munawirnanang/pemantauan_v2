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
$route['forget_pass'] = 'C_auth/forget_pass';
$route['forget'] = 'C_auth/forget';

$route['beranda'] = 'C_beranda/index';

$route['upload_indikator'] = 'C_uploadIndikator/index';
$route['tambah_indikator2'] = 'C_uploadIndikator/tambah_indikator';
$route['edit_indikator2/(:num)'] = 'C_uploadIndikator/edit_indikator/$1';
$route['reset_data_indikator2/(:num)'] = 'C_uploadIndikator/reset_indikator/$1';
$route['upload/(:num)'] = 'C_uploadIndikator/upload/$1';
$route['export_template/(:num)'] = 'C_uploadIndikator/export_template/$1';
$route['import'] = 'C_uploadIndikator/import';
$route['input_upload'] = 'C_uploadIndikator/input_upload';
$route['hapus_upload'] = 'C_uploadIndikator/hapus_upload';


$route['update_indikator'] = 'C_updateIndikator/index';
$route['tambah_indikator'] = 'C_updateIndikator/tambah_indikator';
$route['hapus_indikator'] = 'C_updateIndikator/hapus_indikator';
$route['edit_indikator/(:num)'] = 'C_updateIndikator/edit_indikator/$1';
$route['update_all_indikator'] = 'C_updateIndikator/update_all_data_makro';
$route['update_data_indikator/(:num)'] = 'C_updateIndikator/update_data_makro/$1';
$route['reset_data_indikator/(:num)'] = 'C_updateIndikator/reset_indikator/$1';

$route['indikator'] = 'C_indikator/index';
$route['show_data'] = 'C_indikator/show_data';

$route['data_bps/(:num)'] = 'C_databps/index/$1';
$route['data_kategori/(:num)'] = 'C_databps/data_kategori/$1';
$route['detail_data'] = 'C_databps/detail_data';
$route['export'] = 'C_databps/export';

$route['repositori_dokumen'] = 'C_repositori_dokumen/index';
$route['show_doc'] = 'C_repositori_dokumen/show_doc';
$route['count_doc_by_jenis'] = 'C_repositori_dokumen/count_doc_by_jenis';
$route['zipDok'] = 'C_repositori_dokumen/zipDok';

$route['fitur'] = 'C_fitur/index';
$route['list_fitur'] = 'C_fitur/list_fitur';
$route['tambah_fitur'] = 'C_fitur/tambah_fitur';
$route['hapus_fitur'] = 'C_fitur/hapus_fitur';
$route['edit_fitur/(:num)'] = 'C_fitur/edit_fitur/$1';
$route['ubah_fitur'] = 'C_fitur/ubah_fitur';

$route['sdgs'] = 'C_sdgs/index';
$route['get_goal'] = 'C_sdgs/get_goal';
$route['detail_sdgs'] = 'C_sdgs/detail_sdgs';

$route['user'] = 'C_user/index';
$route['list_user'] = 'C_user/list_user';
$route['tambah_user'] = 'C_user/tambah_user';
$route['hapus_user'] = 'C_user/hapus_user';
$route['edit_user/(:num)'] = 'C_user/edit_user/$1';
$route['ubah_user'] = 'C_user/ubah_user';
$route['ubah_pass'] = 'C_user/ubah_pass';
$route['get_user'] = 'C_user/get_user';

$route['role'] = 'C_role/index';
$route['list_role'] = 'C_role/list_role';
$route['tambah_role'] = 'C_role/tambah_role';
$route['update_role'] = 'C_role/update_role';
$route['hapus_role'] = 'C_role/hapus_role';
$route['edit_role/(:num)'] = 'C_role/edit_role/$1';
$route['ubah_role'] = 'C_role/ubah_role';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
