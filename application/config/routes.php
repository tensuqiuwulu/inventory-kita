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
|	https://codeigniter.com/user_guide/general/routing.html
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
//Auth
$route['authentication'] = 'Auth/authentication';

//Barang
$route['barang'] = 'barang';
$route['input_barang'] = 'barang/FormInputBarang';
$route['add_barang'] = 'barang/AddBarang';
$route['riwayat_transaksi_barang/:any'] = 'barang/RiwayatTransaksiBarang';

//Distribusi
$route['input_distribusi/:any'] = 'distribusi/index';
$route['create_distribusi'] = 'distribusi/create_action';
$route['list_distribusi_kantor'] = 'distribusi/index';
$route['detail_distribusi/:any'] = 'distribusi/index_detail';

//Kategori
$route['kategori'] = 'kategori';
$route['input_kategori'] = 'kategori/FormInputKategori';
$route['edit_kategori/:any'] = 'kategori/FormEditKategori';
$route['create_kategori'] = 'kategori/CreateKategori';
$route['update_kategori'] = 'kategori/UpdateKategori';
$route['delete_kategori/:any'] = 'kategori/DeleteKategori';

//Vendor
$route['vendor'] = 'vendor';
$route['input_vendor'] = 'vendor/FormInputVendor';
$route['edit_vendor/:any'] = 'vendor/FormEditVendor';
$route['create_vendor'] = 'vendor/CreateVendor';
$route['update_vendor'] = 'vendor/UpdateVendor';
$route['delete_vendor/:any'] = 'Vendor/DeleteVendor';

//Pembelian
$route['list_nota'] = 'nota';
$route['form_input_barang'] = 'nota/form_input';
$route['create_pembelian/:any'] = 'nota/form_input_barang';

//nota
$route['create_nota'] = 'nota/create_nota';

//Permintaaan
$route['list_permintaan_barang'] = 'permintaan';
$route['input_permintaan_barang'] = 'Permintaan/InputPermintaan';
$route['add_permintaan'] = 'Permintaan/AddPermintaan';
$route['detail_verifikasi/:any/:any'] = 'Permintaan/DetailVerifikasi';

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
