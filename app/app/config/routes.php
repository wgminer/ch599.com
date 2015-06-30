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

$route['default_controller'] = 'AdminController/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth routes
$route['milagro'] = 'AdminController/login'; 
$route['auth'] = 'AdminController/auth';
$route['deauth'] = 'AdminController/deauth';

// User routes
$route['users'] = 'UserController/index';
$route['users/create'] = 'UserController/create';
$route['users/update/password/(:num)'] = 'UserController/update_password/$1';
$route['users/update/(:num)'] = 'UserController/update/$1';
$route['users/(:num)'] = 'UserController/index/$1';

// Post routes 
$route['songs'] = 'SongController/index';
$route['songs/create'] = 'SongController/create';
$route['songs/update/(:num)'] = 'SongController/update/$1';
$route['songs/delete/(:num)'] = 'SongController/delete/$1';
$route['songs/(:num)'] = 'SongController/get/$1';

// Genre routes 
$route['genres'] = 'GenreController/index';

// Status routes 
$route['statuses'] = 'StatusController/index';

// Admin routes
$route['admin'] = 'AdminController/index';

// Site routes
$route['latest'] = 'SongController/index';
$route['genre/(:any)'] = 'SongController/index';
$route['author/(:any)'] = 'SongController/index';
$route['(:any)'] = 'SongController/get/$1';

