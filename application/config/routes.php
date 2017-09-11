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
//$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//login
$route['default_controller'] = 'login/index';
$route['auth'] = 'login/auth';
$route['auth/inline'] = 'login/authInline';
$route['main'] = 'login/main';
$route['logout'] = 'login/logout';

$route['hq'] = 'hq/hq_login/index';
$route['sess'] = 'login/sess';

/*------------------------
 * API
 * ----------------------*/
 //$route['memb/log'] = 'backend_api/membLogin';
$route['db2/get/(:any)/where/(:any)/(:any)'] = "backend_api/getDataWithSpecificField/$1/$2/$3";
$route['db1/list/from/(:any)/(:any)/(:any)'] = "backend_api/getRetrieveAllFieldB1/$1/$2/$3";
$route['db2/get/(:any)/from/(:any)/(:any)/(:any)'] = "backend_api/getRetrieveFieldDB2/$1/$2/$3/$4";
$route['api/member/check/(:any)'] = "backend_api/checkValidIdMember/$1";
$route['api/member/double/(:any)/(:any)'] = "backend_api/memberCheckExistingRecordByField/$1/$2";
$route['api/test'] = "backend_api/tesAPI";
$route['get/random/member'] = "backend_api/get100Member";
/*-------------------------------
 * APPLICATION MAINTENANCE ADMIN
 * ------------------------------ */
$route['app'] = 'userconfig/userconfig/getInputApplication';
$route['app/id/(:any)'] = 'userconfig/userconfig/getListApplicationByID/$1';
$route['app/list'] = 'userconfig/userconfig/getListAllApplication';
$route['app/list/json'] = 'userconfig/userconfig/getListAllApplication/$1';
$route['app/list/(:any)/(:any)'] = 'userconfig/userconfig/getListApplication/$1/$2';
$route['app/save'] = 'userconfig/userconfig/saveInputApplication';
$route['app/update'] = 'userconfig/userconfig/saveUpdateApplication';
$route['app/delete/(:any)'] = 'userconfig/userconfig/deleteApplication/$1';

/*--------------------------
 * USER MAINTENANCE ADMIN
 * ------------------------ */
$route['user'] = 'userconfig/userconfig/getInputUser';
$route['user/id/(:any)'] = 'userconfig/userconfig/getListUserByID/$1';
$route['user/save'] = 'userconfig/userconfig/saveInputUser';
$route['user/list'] = 'userconfig/userconfig/getListAllUser';
$route['user/param/(:any)/(:any)'] = 'userconfig/userconfig/getListAllUserByParam/$1/$2';
$route['user/list/(:any)/(:any)'] = 'userconfig/userconfig/getListUser/$1/$2';
$route['user/update'] = 'userconfig/userconfig/saveUpdateUser';
$route['user/delete/(:any)'] = 'userconfig/userconfig/deleteUser/$1';

/*--------------------------
 * USER GROUP MAINTENANCE ADMIN
 * ------------------------ */
$route['user/group'] = 'userconfig/userconfig/getInputUserGroup';
$route['user/group/id/(:any)'] = 'userconfig/userconfig/getListUserGroupByID/$1';
$route['user/group/list'] = 'userconfig/userconfig/getListAllUserGroup';
$route['user/group/list/json'] = 'userconfig/userconfig/getListAllUserGroup/$1';
$route['user/group/list/(:any)/(:any)'] = 'userconfig/userconfig/getListUserGroup/$1/$2';
$route['user/group/save'] = 'userconfig/userconfig/saveInputUserGroup';
$route['user/group/update'] = 'userconfig/userconfig/saveUpdateUserGroup';
$route['user/group/delete/(:any)'] = 'userconfig/userconfig/deleteUserGroup/$1';

/*--------------------------
 * GROUP MENU MAINTENANCE ADMIN
 * ------------------------ */
$route['menu/group'] = 'userconfig/userconfig/getInputGroupMenu';
$route['menu/group/list'] = 'userconfig/userconfig/getListAllGroupMenu';
$route['menu/group/list/json'] = 'userconfig/userconfig/getListAllGroupMenu/$1';
$route['menu/group/id/(:any)'] = 'userconfig/userconfig/getListGroupMenuByID/$1';
$route['menu/group/list/(:any)/(:any)'] = 'userconfig/userconfig/getListGroupMenu/$1/$2';
$route['menu/group/save'] = 'userconfig/userconfig/saveInputGroupMenu';
$route['menu/group/update'] = 'userconfig/userconfig/saveUpdateGroupMenu';
$route['menu/group/delete/(:any)'] = 'userconfig/userconfig/deleteGroupMenu/$1';

/*--------------------------
 * SUB MENU MAINTENANCE ADMIN
 * ------------------------ */
$route['menu'] = 'userconfig/userconfig/getInputSubMenu';
$route['menu/list'] = 'userconfig/userconfig/getListAllSubMenu';
$route['menu/list/json'] = 'userconfig/userconfig/getListAllSubMenu/$1';
$route['menu/id/(:any)'] = 'userconfig/userconfig/getListSubMenuByID/$1';
$route['menu/list/(:any)/(:any)'] = 'userconfig/userconfig/getListSubMenu/$1/$2';
$route['menu/save'] = 'userconfig/userconfig/saveInputSubMenu';
$route['menu/update'] = 'userconfig/userconfig/saveUpdateSubMenu';
$route['menu/delete/(:any)'] = 'userconfig/userconfig/deleteSubMenu/$1';

/*--------------------------
 * USER GROUP PRIVELEDGE MENU
 * ------------------------ */
$route['menu/access'] = 'userconfig/userconfig/getInputAccessMenu';
$route['menu/check'] = 'userconfig/userconfig/getShowListMenuByGroupID';
$route['menu/access/save'] = 'userconfig/userconfig/saveInputAccessMenu';


/*--------------------------
 * DISTRIBUTOR TRANSACTION
 * ------------------------ */
$route['member/trx'] = 'transaction/sales_member/memberTrxSearch';
$route['member/trx/search'] = 'transaction/sales_member/memberTrxSearchResult';
$route['member/trx/detail/(:any)/(:any)'] = 'transaction/sales_member/memberTrxDetailProductByID/$1/$2';
/*------------------------------
 * STOCKIST PERSONAL PARTICULAR
 * --------------------------- */
$route['stockist/addr'] = 'stockist/stockist/formUpdateAddrStk';
$route['stockist/addr/update'] = 'stockist/stockist/saveUpdateAddrStk';
$route['stockist/info'] = 'stockist/stockist/formStockistInfo';
$route['stockist/id/(:any)'] = 'stockist/stockist/getDetailStockistByID/$1'; 

/*------------------------------
 * PRODUCT
 -------------------------------*/
$route['product/search'] = 'product/product/productSearch';
$route['product/search/list'] = 'product/product/productSearchByParam';
$route['product/id/(:any)/(:any)'] = 'product/product/productSearchByID/$1/$2';
/*------------------------------
 * MEMBER
 -------------------------------*/
$route['member/reg'] = 'member/member_registration/regMember';
$route['member/voucher/check/(:any)/(:any)'] = 'member/member_registration/checkVoucher/$1/$2';
$route['member/reg/input'] = 'member/member_registration/inputMember';
$route['member/list/stk/(:any)'] = 'member/member_registration/showStockistByArea/$1';
$route['member/reg/input/save'] = 'member/member_registration/saveInputMember';
$route['member/reg/couple'] = 'member/member/regMemberCouple';
$route['member/reg/id/(:any)'] = 'member/member_registration/showNewMember/$1';
/*------------------------------
 * MEMBER REPORT & SEARCH
 -------------------------------*/
$route['member/search'] = 'member/member_report/searchMember';
$route['member/search/list'] = 'member/member_report/searchMemberList';
$route['member/id/(:any)'] = 'member/member_report/getMemberByID/$1';

/*----------------------
 * LBC MEMBER
 * --------------------*/
$route['lbc'] = 'member/lbc/regLbcMember';
$route['lbc/id/(:any)'] = 'member/lbc/checkLbcByID/$1';
$route['lbc/save'] = 'member/lbc/saveRegLbc';
$route['lbc/report'] = 'member/lbc/lbcReport';
$route['lbc/report/list'] = 'member/lbc/lbcReportList';

/*--------------------------
 * INCOMING PAYMENT UPDATE
 * -------------------------*/
$route['incoming/update'] = 'transaction/incoming_payment/formUpdateIncomingPayment';
$route['incoming/detail'] = 'transaction/incoming_payment/getDetailIncomingPayment';
$route['incoming/fullname/(:any)/(:any)'] = 'transaction/incoming_payment/getDetailFullname/$1/$2';
$route['incoming/update/save'] = 'transaction/incoming_payment/saveUpdateIncomingPayment';
/*--------------------------------
 * SALES INPUT, GENERATE & REPORT
 * ------------------------------*/
$route['sales/stk/ttp/input'] = 'transaction/sales_stockist/inputTTP'; 
$route['sales/stk/input/list'] = 'transaction/sales_stockist/getListInputSalesStockist';
$route['sales/stk/update/(:any)/(:any)'] = 'transaction/sales_stockist/updateTrx/$1/$2';
$route['sales/stk/input/form'] = 'transaction/sales_stockist/inputTrxForm';
$route['sales/stk/info/(:any)'] = 'transaction/sales_stockist/getStockistInfo/$1';
$route['sales/stk/save'] = 'transaction/sales_stockist/saveTrxStockist';


$route['sales/vc/check/(:any)/(:any)/(:any)'] = 'transaction/sales_stockist/checkValidVoucherCash/$1/$2/$3';
$route['sales/sub/ttp/input'] = 'transaction/sales_stockist/inputTtpSub'; 
//$route['sales/sub/input/list'] = 'transaction/sales_stockist/getListInputSalesStockist';
//$route['sales/sub/update/(:any)/(:any)'] = 'transaction/sales_stockist/updateTrx/$1/$2';
$route['sales/sub/input/form'] = 'transaction/sales_stockist/inputTrxFormSub';
//$route['sales/sub/save'] = 'transaction/sales_stockist/saveTrxStockist';
 
 
$route['sales/input'] = 'transaction/sales_stockist/inputSales';
$route['sales/input/save'] = 'transaction/sales_stockist/saveInputSales';

$route['sales/generate'] = 'transaction/sales_generate/formGenerateScoTrx';
$route['sales/search/list'] = 'transaction/sales_generate/searchUngeneratedSales';
$route['sales/detail/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'transaction/sales_generate/getDetailSales/$1/$2/$3/$4/$5';
$route['sales/generate/preview'] = 'transaction/sales_generate/previewGenerate';

$route['sales/pvr/input'] = 'transaction/sales_stockist/inputSalesPvr';
$route['sales/pvr/input/list'] = 'transaction/sales_stockist/getListInputPvrSalesStockist';
$route['sales/pvr/input/form'] = 'transaction/sales_stockist/inputTrxPvrForm';
$route['sales/pvr/input/save'] = 'transaction/sales_stockist/saveInputSalesPvr';

$route['sales/generated/report'] = 'transaction/sales_stockist_report/formListGeneratedSales';
$route['sales/generated/report/list'] = 'transaction/sales_stockist_report/getListGeneratedSales';
$route['sales/generated/ssr/(:any)'] = 'transaction/sales_stockist_report/getDetailTrxBySSR/$1';

$route['sales/voucher/report'] = 'transaction/sales_stockist_report/voucherReport';
$route['sales/voucher/report/list'] = 'transaction/sales_stockist_report/voucherReportList';
$route['sales/voucher/no/(:any)'] = 'transaction/sales_stockist_report/getDetailVoucherNo/$1';
/*---------------------
 * SALES ONLINE 
 * -------------------*/
 $route['sales/ol/redemp'] = 'transaction/sales_online/formOnlineRedemp';
 $route['sales/ol/redemp/list'] = 'transaction/sales_online/searchOnlineRedemp';
 $route['sales/ol/orderno/(:any)'] = 'transaction/sales_online/onlineTrxDetail/$1';
 $route['sales/ol/redemp/save'] = 'transaction/sales_online/onlineRedempSave';
 $route['sales/ol/reprint/(:any)'] = 'transaction/sales_online/reprintNote/$1';
 
 /*------------------------------
  * STOCK BARCODE
  * ----------------------------*/
$route['stk/barcode'] = 'transaction/stock_barcode/formStockBarcode';
$route['stk/barcode/wh/list'] = 'transaction/stock_barcode/getListWH';
$route['stk/barcode/trx/list'] = 'transaction/stock_barcode/getListTrx';
$route['stk/barcode/trx/id/(:any)'] = 'transaction/stock_barcode/getDetailProductByTrxId/$1';
$route['stk/barcode/process/(:any)/(:any)'] = 'transaction/stock_barcode/getListProductBarcode/$1/$2';
$route['stk/barcode/save'] = 'transaction/stock_barcode/saveBarcode';
$route['stk/barcode/prepare/pl'] = 'transaction/stock_barcode/preparePackingList';
$route['stk/barcode/generate/pl'] = 'transaction/stock_barcode/generatePackingList';
/*--------------------------
 * WAREHOUSE
 * ------------------------*/
 
 /*-----------------------
  * VOUCHER RELEASE
  * ---------------------*/
$route['voucher/search'] = 'member/voucher/voucherSearchForm';
$route['voucher/search/list'] = 'member/voucher/voucherSearchResult';
$route['voucher/detail/(:any)'] = 'member/voucher/voucherDetail/$1';
$route['voucher/product/(:any)/(:any)'] = 'member/voucher/detailReleasedSK/$1/$2';
$route['voucher/check/formno/(:any)/(:any)'] = 'member/voucher/checkVoucherNo/$1/$2';
$route['wh/releasevcr/upd/(:any)/(:any)/(:any)'] = 'backend/warehouse/getReleaseVcrSKupd/$1/$2/$3';


$route['voucher/release'] = 'member/voucher/saveReleaseVoucher';



