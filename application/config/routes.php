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

$route['default_controller'] = "login";
$route['404_override'] = 'login/not_found';
$route['unit']='unit';

//**** Sales Channel Master ****//
$route['master/sales_channel'] = 'sales_channel';
$route['master/sc_add'] = 'sales_channel/add';
$route['master/sc_add/(:any)'] = 'sales_channel/add/$1';
$route['master/sc_showrows'] = 'sales_channel/showRows';
$route['master/sc_save'] = 'sales_channel/save';
$route['master/sc_delete/(:any)'] = 'sales_channel/delete/$1';
//**** Product Category Master ****//
$route['master/prdc_category'] = 'product_category';
$route['master/prc_add'] = 'product_category/add';
$route['master/prc_add/(:any)'] = 'product_category/add/$1';
$route['master/prc_showrows'] = 'product_category/showRows';
$route['master/prc_save'] = 'product_category/save';
$route['master/prc_delete/(:any)'] = 'product_category/delete/$1';
//**** Touch Point Master ****//
$route['master/touch_point'] = 'touch_point';
$route['master/tp_add'] = 'touch_point/add';
$route['master/tp_add/(:any)'] = 'touch_point/add/$1';
$route['master/tp_showrows'] = 'touch_point/showRows';
$route['master/tp_save'] = 'touch_point/save';
$route['master/tp_delete/(:any)'] = 'touch_point/delete/$1';
//**** Nature of Case Master ****//
$route['master/case_nature'] = 'case_nature';
$route['master/cn_add'] = 'case_nature/add';
$route['master/cn_add/(:any)'] = 'case_nature/add/$1';
$route['master/cn_showrows'] = 'case_nature/showRows';
$route['master/cn_save'] = 'case_nature/save';
$route['master/cn_delete/(:any)'] = 'case_nature/delete/$1';
//**** Case Topic Master ****//
$route['master/case_topic'] = 'case_topic';
$route['master/ct_add'] = 'case_topic/add';
$route['master/ct_add/(:any)'] = 'case_topic/add/$1';
$route['master/ct_showrows'] = 'case_topic/showRows';
$route['master/ct_save'] = 'case_topic/save';
$route['master/ct_delete/(:any)'] = 'case_topic/delete/$1';
//**** Contractor / Installer / Supplier Master ****//
$route['master/con'] = 'contractor';
$route['master/con_add'] = 'contractor/add';
$route['master/con_add/(:any)'] = 'contractor/add/$1';
$route['master/con_showrows'] = 'contractor/showRows';
$route['master/con_save'] = 'contractor/save';
$route['master/con_delete/(:any)'] = 'contractor/delete/$1';
//**** Issue Master ****//
$route['master/prblm'] = 'issue';
$route['master/prblm_add'] = 'issue/add';
$route['master/prblm_add/(:any)'] = 'issue/add/$1';
$route['master/prblm_showrows'] = 'issue/showRows';
$route['master/prblm_save'] = 'issue/save';
$route['master/prblm_delete/(:any)'] = 'issue/delete/$1';
$route['master/prblm_topic'] = 'issue/getIssuesFrmTopic';

//**** Root Cause Master ****//
$route['master/rc'] = 'root_cause';
$route['master/rc_add'] = 'root_cause/add';
$route['master/rc_add/(:any)'] = 'root_cause/add/$1';
$route['master/rc_showrows'] = 'root_cause/showRows';
$route['master/rc_save'] = 'root_cause/save';
$route['master/rc_delete/(:any)'] = 'root_cause/delete/$1';
$route['master/rc_issue'] = 'root_cause/getCauseFrmIssue';
//**** Owner of Root Cause Master ****//
$route['master/orc'] = 'owner_root_cause';
$route['master/orc_add'] = 'owner_root_cause/add';
$route['master/orc_add/(:any)'] = 'owner_root_cause/add/$1';
$route['master/orc_showrows'] = 'owner_root_cause/showRows';
$route['master/orc_save'] = 'owner_root_cause/save';
$route['master/orc_delete/(:any)'] = 'owner_root_cause/delete/$1';


$route['master/enquiry'] = 'enquiry';
$route['master/enquiry_add'] = 'enquiry/add';
$route['master/enquiry_add/(:any)'] = 'enquiry/add/$1';
$route['master/enquiry_showrows'] = 'enquiry/showRows';
$route['master/enquiry_save'] = 'enquiry/save';
$route['master/enquiry_delete/(:any)'] = 'enquiry/delete/$1';
$route['master/enquiry_search'] = 'enquiry/search';
$route['master/enquiry_reset'] = 'enquiry/reset';
$route['master/enquiry_export'] = 'enquiry/export';

$route['master/wikicourts'] = 'login/wikicourts';
/* End of file routes.php */
/* Location: ./application/config/routes.php */