<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 'posts';
$route['404_override'] = '';

// ADMIN ROUTES
$route['join'] = 'authors/join';
$route['authors/create'] = 'authors/create';

$route['milagro'] = 'authors/login';
$route['authors/validate'] = 'authors/validate';

$route['dashboard'] = 'authors/dashboard';

$route['settings'] = 'authors/settings';
$route['authors/update'] = 'authors/update';
$route['authors/photo'] = 'authors/photo';
$route['authors/password'] = 'authors/password';

$route['new'] = 'posts/compose';
$route['posts/create'] = 'posts/create';
$route['tweet'] = 'posts/tweet';
$route['posts/post_tweet'] = 'posts/post_tweet';
$route['facebook'] = 'posts/facebook';
$route['posts/post_facebook'] = 'posts/post_facebook';

$route['rip'] = 'posts/soundcloud';
$route['posts/download'] = 'posts/download';

$route['edit/(:num)'] = 'posts/edit/$1';
$route['delete/(:num)'] = 'posts/delete/$1';
$route['posts/update'] = 'posts/update';
$route['posts/update_genre'] = 'posts/update_genre';

$route['posts/errors/(:any)'] = 'posts/errors/&1';

$route['sitemap'] = 'seo/sitemap';

$route['logout'] = 'authors/logout';

// APP ROUTES
$route['autoplay'] = 'posts/autoplay';
$route['playlist'] = 'posts/playlist';
$route['search'] = 'posts/search';
$route['(:any)'] = 'posts/router/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */