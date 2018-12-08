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
$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['menu/(:any)']='Welcome/menu';
$route['wishlist']='Welcome/wishlist';
$route['deletewishlist/(:num)']='Welcome/deleteWishlist';

$route['addtocart']='Cart/addToCart';
$route['addtocompare']='Cart/addToCompare';
$route['addtowishlist']='Cart/addToWishlist';
$route['cart']='Cart/cartList';
$route['checkout']='Cart/checkout';
$route['removecartitem']='Cart/deleteCartItem';
$route['updatecartqty']='Cart/updateCartQty';
$route['getcoupondetails'] = 'Cart/checkCouponDetails';
//Description details page
$route['details/(:any)/(:any)']='Product/productDescription';
//Product Listing
$route['products']='Product/productListing';
$route['menulist/(:any)/(:any)']='Product/productListing';
$route['gallery']='Product/productListing';
//user realted
$route['login']='User/login';
$route['register']='User/register';
$route['wishlist']='User/wishlist';
$route['api/signup']='Userapi/signup';
$route['api/accountverification']='Userapi/verifyaccount';
$route['api/login']='Userapi/userLogin';
$route['api/forgotpassword']='Userapi/userForgotReq';
$route['api/resetpassword']='Userapi/setForgotPassword';
$route['api/updatepassword']='Userapi/changePassword';
$route['api/profiledetails']='Userapi/profileDetails';
$route['api/updateprofile']='Userapi/updateProfile';
$route['api/createaddress']='Userapi/createAddress';
$route['api/addresslist']='Userapi/userAddressList';
$route['api/addressdetails']='Userapi/addressDetails';
$route['api/updateaddress']='Userapi/updateAddress';
$route['api/deleteaddress']='Userapi/deleteAddress';
$route['profile']='User/profile';
$route['logout']='User/signOut';
/*
|--------------------------------------------------------------------------
| Front end routes
|--------------------------------------------------------------------------
 */
$route['aboutus']='Cms/aboutus';
$route['contactus']='Cms/contactus';
$route['blog']='Cms/blog';
$route['affiliates']='Cms/affiliates';
$route['careers']='Cms/careers';
$route['faqs']='Cms/faqs';
$route['support']='Cms/support';

/*
|--------------------------------------------------------------------------
| Front end routes end
|--------------------------------------------------------------------------
 */
/*
|--------------------------------------------------------------------------
| Super admin routes
|--------------------------------------------------------------------------
 */
$route['superadmin']='superadmin/Welcome';
$route['superadmin/signup']='superadmin/Welcome/login';
$route['superadmin/changepassword']='superadmin/Welcome/changePassword';
/*
|--------------------------------------------------------------------------
| Order related routes
|--------------------------------------------------------------------------
 */
$route['booking/success']='Cart/bookingSuccess';
$route['booking/fail']='Cart/bookingFail';
