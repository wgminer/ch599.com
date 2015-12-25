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

$route['default_controller'] = 'view/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// API Routes

    // User
    $route['api/users'] = 'user/index';
    $route['api/users/create'] = 'user/create';
    $route['api/users/update/password/(:num)'] = 'user/update_password/$1';
    $route['api/users/update/(:num)'] = 'user/update/$1';
    $route['api/users/(:num)'] = 'user/index/$1';

    // Post 
    $route['api/songs'] = 'song/index';
    $route['api/songs/create'] = 'song/create';
    $route['api/songs/update/(:num)'] = 'song/update/$1';
    $route['api/songs/delete/(:num)'] = 'song/delete/$1';
    $route['api/songs/(:num)'] = 'song/get/$1';

    // Genre 
    $route['api/genres'] = 'genre/index';

    // Status 
    $route['api/statuses'] = 'status/index';


// Admin Routes

    $route['milagro'] = 'view/login'; 
    $route['auth'] = 'auth/auth';
    $route['sign-out'] = 'auth/deauth';

    $route['dashboard'] = 'view/dashboard';
    $route['profile'] = 'view/profile';
    $route['errors'] = 'cron/errors';


// Channel Routes

    $route['latest'] = 'view/latest';
    $route['authors'] = 'view/authors';

    $route['genre/(:any)'] = 'view/genre/$1';
    $route['g/(:any)'] = 'view/genre/$1';

    $route['author/(:any)'] = 'view/author/$1';
    $route['a/(:any)'] = 'view/author/$1';

    $route['song/(:any)'] = 'view/song/$1';
    $route['s/(:any)'] = 'view/song/$1';

    $route['search'] = 'view/search';

    

