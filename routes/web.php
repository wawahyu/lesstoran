<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('admin/dashboard');
});
Route::get('banned', function () {
    return view('banned');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware'=>'auth'], function(){
	
	Route::group(['middleware'=>'AdminMiddleware'], function(){
		
		/*---------- Dashboard ----------*/
		Route::get('/admin/dashboard', 'Admin\AdminController@dashboard');

		/*---------- Masakan ----------*/
		Route::get('/admin/masakan', 'Admin\MasakanController@masakan_index');
		Route::get('/admin/masakan/filter/{filter}', 'Admin\MasakanController@masakan_filter');
		Route::get('/admin/masakan/datatables', 'Admin\MasakanController@masakan_datatables');
		Route::get('/admin/masakan/datatables/filter/{filter}', 'Admin\MasakanController@masakan_filter_datatables');
		Route::get('/admin/masakan/{filter}/add', 'Admin\MasakanController@masakan_add');
		Route::post('/admin/masakan/store', 'Admin\MasakanController@masakan_store');
		Route::get('/admin/masakan/{filter}/{id}/edit', 'Admin\MasakanController@masakan_edit');
		Route::post('/admin/masakan/{id}/update', 'Admin\MasakanController@masakan_update');
		Route::get('/admin/masakan/delete', 'Admin\MasakanController@masakan_delete');

		/*---------- Meja ----------*/
		Route::get('/admin/meja', 'Admin\MejaController@meja_index');
		Route::get('/admin/meja/datatables', 'Admin\MejaController@meja_datatables');
		Route::get('/admin/meja/add', 'Admin\MejaController@meja_add');
		Route::post('/admin/meja/store', 'Admin\MejaController@meja_store');
		Route::get('/admin/meja/{id}/edit', 'Admin\MejaController@meja_edit');
		Route::post('/admin/meja/{id}/update', 'Admin\MejaController@meja_update');
		Route::get('/admin/meja/delete', 'Admin\MejaController@meja_delete');

		/*---------- User ----------*/
        Route::get('/admin/user', 'Admin\UserController@user_index');
        Route::get('/admin/user/filter/{filter}', 'Admin\UserController@user_filter');
        Route::get('/admin/user/datatables', 'Admin\UserController@user_datatables');
        Route::get('/admin/user/datatables/filter/{filter}', 'Admin\UserController@user_filter_datatables');
        Route::get('/admin/user/{filter}/add/', 'Admin\UserController@user_add');
        Route::post('/admin/user/store', 'Admin\UserController@user_store');
        Route::get('/admin/user/{filter}/{id}/edit', 'Admin\UserController@user_edit');
        Route::post('/admin/user/{id}/update', 'Admin\UserController@user_update');
        Route::get('/admin/user/delete', 'Admin\UserController@user_delete');
        Route::get('/admin/user/resign/back/{id}', 'Admin\userController@user_resign_back');
        Route::get('/admin/user/{filter}/{id}/reset', 'Admin\UserController@user_reset');

		/*---------- Create Order ----------*/
		Route::get('/admin/order', 'Admin\OrderController@order_index');
		Route::get('/admin/order/myorder', 'Admin\OrderController@order_myorder_index');
		Route::get('/admin/order/filter/{filter}', 'Admin\OrderController@order_filter');
		Route::get('/admin/order/myorder/filter/{filter}', 'Admin\OrderController@order_myorder_filter');
		Route::get('/admin/order/datatables', 'Admin\OrderController@order_datatables');
		Route::get('/admin/order/datatables/filter/{filter}', 'Admin\OrderController@order_filter_datatables');
		Route::get('/admin/order/myorder/datatables', 'Admin\OrderController@order_myorder_datatables');
		Route::get('/admin/order/myorder/datatables/filter/{filter}', 'Admin\OrderController@order_myorder_filter_datatables');
		Route::post('/admin/order/{id}/add', 'Admin\OrderController@order_add');
		Route::post('/admin/order/{id}/edit', 'Admin\OrderController@order_edit');
		Route::get('/admin/order/delete', 'Admin\OrderController@order_delete');
		Route::post('/admin/order/send', 'Admin\OrderController@order_send');

		/*---------- Accept Order ----------*/
		Route::get('/admin/order/list', 'Admin\OrderListController@order_list_index');
		Route::get('/admin/order/list/datatables', 'Admin\OrderListController@order_list_datatables');
		Route::get('/admin/list/order/datatables', 'Admin\OrderListController@list_order_datatables');
		Route::get('/admin/order/list/update', 'Admin\OrderListController@order_list_update');

		/*---------- Create Transaction ----------*/
		Route::get('/admin/transaction', 'Admin\TransactionController@transaction_index');
		Route::get('/admin/transaction/datatables', 'Admin\TransactionController@transaction_datatables');
		Route::get('/admin/transaction/update', 'Admin\TransactionController@transaction_update');

		/*---------- Accept Transaction ----------*/
		Route::get('/admin/transaction/list', 'Admin\TransactionListController@transaction_list_index');
		Route::get('/admin/transaction/list/datatables', 'Admin\TransactionListController@transaction_list_datatables');
		Route::get('/admin/list/transaction/datatables', 'Admin\TransactionListController@list_transaction_datatables');
		Route::post('/admin/transaction/list/{id}/update', 'Admin\TransactionListController@transaction_list_update');
		Route::get('/admin/transaction/list/{id}/print', 'Admin\TransactionListController@transaction_list_print');

		/*---------- Generate Report ----------*/
		Route::get('/admin/laporan/filter/{filter}', 'Admin\LaporanController@laporan_index');

		/*---------- My Account ----------*/
		Route::get('/admin/myaccount', 'Admin\MyAccountController@myaccount_index');
		Route::post('/admin/myaccount/edit', 'Admin\MyAccountController@myaccount_edit');
		Route::get('/admin/myaccount/password', 'Admin\MyAccountController@myaccount_password');
		Route::post('/admin/myaccount/password/edit', 'Admin\MyAccountController@myaccount_edit_password');
	});
	
	Route::group(['middleware'=>'OwnerMiddleware'], function(){

		/*---------- Dashboard ----------*/
		Route::get('/owner/dashboard', 'Owner\OwnerController@dashboard');

		/*---------- Generate Report ----------*/
		Route::get('/owner/laporan/filter/{filter}', 'Owner\laporanController@laporan_index');
		Route::get('/owner/masakan/datatables', 'Owner\MasakanController@masakan_datatables');
		Route::get('/owner/user/datatables/filter/{filter}', 'Owner\UserController@user_filter_datatables');
		Route::get('/owner/list/order/datatables', 'Owner\OrderListController@list_order_datatables');
		Route::get('/owner/list/transaction/datatables', 'Owner\TransactionListController@list_transaction_datatables');

		/*---------- My Account ----------*/
		Route::get('/owner/myaccount', 'Owner\MyAccountController@myaccount_index');
		Route::post('/owner/myaccount/edit', 'Owner\MyAccountController@myaccount_edit');
		Route::get('/owner/myaccount/password', 'Owner\MyAccountController@myaccount_password');
		Route::post('/owner/myaccount/password/edit', 'Owner\MyAccountController@myaccount_edit_password');
	});

	Route::group(['middleware'=>'CustomerMiddleware'], function(){
		
		/*---------- Dashboard ----------*/
		Route::get('order', 'Customer\OrderController@order_index');
		
		/*---------- Create Order ----------*/
		Route::get('/order/myorder', 'Customer\OrderController@order_myorder_index');
		Route::get('/order/filter/{filter}', 'Customer\OrderController@order_filter');
		Route::get('/order/myorder/filter/{filter}', 'Customer\OrderController@order_myorder_filter');
		Route::get('/order/datatables', 'Customer\OrderController@order_datatables');
		Route::get('/order/datatables/filter/{filter}', 'Customer\OrderController@order_filter_datatables');
		Route::get('/order/myorder/datatables', 'Customer\OrderController@order_myorder_datatables');
		Route::get('/order/myorder/datatables/filter/{filter}', 'Customer\OrderController@order_myorder_filter_datatables');
		Route::post('/order/{id}/add', 'Customer\OrderController@order_add');
		Route::post('/order/{id}/edit', 'Customer\OrderController@order_edit');
		Route::get('/order/delete', 'Customer\OrderController@order_delete');
		Route::post('/order/send', 'Customer\OrderController@order_send');

		/*---------- Create Transaction ----------*/
		Route::get('/transaction', 'Customer\TransactionController@transaction_index');
		Route::get('/transaction/datatables', 'Customer\TransactionController@transaction_datatables');
		Route::get('/transaction/update', 'Customer\TransactionController@transaction_update');

		/*---------- My Account ----------*/
		Route::get('/customer/myaccount', 'Customer\MyAccountController@myaccount_index');
		Route::post('/customer/myaccount/edit', 'Customer\MyAccountController@myaccount_edit');
		Route::get('/customer/myaccount/password', 'Customer\MyAccountController@myaccount_password');
		Route::post('/customer/myaccount/password/edit', 'Customer\MyAccountController@myaccount_edit_password');
	});

	Route::group(['middleware'=>'CashierMiddleware'], function(){
		/*---------- Dashboard ----------*/
		Route::get('/cashier/dashboard', 'Cashier\CashierController@dashboard');

		/*---------- User ----------*/
        Route::get('/cashier/user', 'Cashier\UserController@user_index');
        Route::get('/cashier/user/filter/{filter}', 'Cashier\UserController@user_filter');
        Route::get('/cashier/user/datatables', 'Cashier\UserController@user_datatables');
        Route::get('/cashier/user/datatables/filter/{filter}', 'Cashier\UserController@user_filter_datatables');
        Route::get('/cashier/user/{filter}/add/', 'Cashier\UserController@user_add');
        Route::post('/cashier/user/store', 'Cashier\UserController@user_store');
        Route::get('/cashier/user/{filter}/{id}/edit', 'Cashier\UserController@user_edit');
        Route::post('/cashier/user/{id}/update', 'Cashier\UserController@user_update');
        Route::get('/cashier/user/delete', 'Cashier\UserController@user_delete');

        /*---------- Accept Transaction ----------*/
		Route::get('/cashier/transaction/list', 'Cashier\TransactionListController@transaction_list_index');
		Route::get('/cashier/transaction/list/datatables', 'Cashier\TransactionListController@transaction_list_datatables');
		Route::get('/cashier/list/transaction/datatables', 'Cashier\TransactionListController@list_transaction_datatables');
		Route::post('/cashier/transaction/list/{id}/update', 'Cashier\TransactionListController@transaction_list_update');
		Route::get('/cashier/transaction/list/{id}/print', 'Cashier\TransactionListController@transaction_list_print');

		/*---------- Generate Report ----------*/
		Route::get('/cashier/laporan/filter/{filter}', 'Cashier\LaporanController@laporan_index');
		Route::get('/cashier/masakan/datatables', 'Cashier\MasakanController@masakan_datatables');
		Route::get('/cashier/list/order/datatables', 'Cashier\OrderListController@list_order_datatables');

		/*---------- My Account ----------*/
		Route::get('/cashier/myaccount', 'Cashier\MyAccountController@myaccount_index');
		Route::post('/cashier/myaccount/edit', 'Cashier\MyAccountController@myaccount_edit');
		Route::get('/cashier/myaccount/password', 'Cashier\MyAccountController@myaccount_password');
		Route::post('/cashier/myaccount/password/edit', 'Cashier\MyAccountController@myaccount_edit_password');
	});

	Route::group(['middleware'=>'WaiterMiddleware'], function(){
		/*---------- Dashboard ----------*/
		Route::get('/waiter/dashboard', 'Waiter\WaiterController@dashboard');

		/*---------- User ----------*/
        Route::get('/waiter/user', 'Waiter\UserController@user_index');
        Route::get('/waiter/user/filter/{filter}', 'Waiter\UserController@user_filter');
        Route::get('/waiter/user/datatables', 'Waiter\UserController@user_datatables');
        Route::get('/waiter/user/datatables/filter/{filter}', 'Waiter\UserController@user_filter_datatables');
        Route::get('/waiter/user/{filter}/add/', 'Waiter\UserController@user_add');
        Route::post('/waiter/user/store', 'Waiter\UserController@user_store');
        Route::get('/waiter/user/{filter}/{id}/edit', 'Waiter\UserController@user_edit');
        Route::post('/waiter/user/{id}/update', 'Waiter\UserController@user_update');
        Route::get('/waiter/user/delete', 'Waiter\UserController@user_delete');

        /*---------- Create Order ----------*/
		Route::get('/waiter/order', 'Waiter\OrderController@order_index');
		Route::get('/waiter/order/myorder', 'Waiter\OrderController@order_myorder_index');
		Route::get('/waiter/order/filter/{filter}', 'Waiter\OrderController@order_filter');
		Route::get('/waiter/order/myorder/filter/{filter}', 'Waiter\OrderController@order_myorder_filter');
		Route::get('/waiter/order/datatables', 'Waiter\OrderController@order_datatables');
		Route::get('/waiter/order/datatables/filter/{filter}', 'Waiter\OrderController@order_filter_datatables');
		Route::get('/waiter/order/myorder/datatables', 'Waiter\OrderController@order_myorder_datatables');
		Route::get('/waiter/order/myorder/datatables/filter/{filter}', 'Waiter\OrderController@order_myorder_filter_datatables');
		Route::post('/waiter/order/{id}/add', 'Waiter\OrderController@order_add');
		Route::post('/waiter/order/{id}/edit', 'Waiter\OrderController@order_edit');
		Route::get('/waiter/order/delete', 'Waiter\OrderController@order_delete');
		Route::post('/waiter/order/send', 'Waiter\OrderController@order_send');

		/*---------- Create Transaction ----------*/
		Route::get('/waiter/transaction', 'Waiter\TransactionController@transaction_index');
		Route::get('/waiter/transaction/datatables', 'Waiter\TransactionController@transaction_datatables');
		Route::get('/waiter/transaction/update', 'Waiter\TransactionController@transaction_update');

        /*---------- Accept Order ----------*/
		Route::get('/waiter/order/list', 'Waiter\OrderListController@order_list_index');
		Route::get('/waiter/order/list/datatables', 'Waiter\OrderListController@order_list_datatables');
		Route::get('/waiter/list/order/datatables', 'Waiter\OrderListController@list_order_datatables');
		Route::get('/waiter/order/list/update', 'Waiter\OrderListController@order_list_update');
        
        /*---------- Generate Report ----------*/
		Route::get('/waiter/laporan/filter/{filter}', 'Waiter\LaporanController@laporan_index');
		Route::get('/waiter/list/transaction/datatables', 'Waiter\TransactionListController@list_transaction_datatables');
		Route::get('/waiter/masakan/datatables', 'Waiter\MasakanController@masakan_datatables');

		/*---------- My Account ----------*/
		Route::get('/waiter/myaccount', 'Waiter\MyAccountController@myaccount_index');
		Route::post('/waiter/myaccount/edit', 'Waiter\MyAccountController@myaccount_edit');
		Route::get('/waiter/myaccount/password', 'Waiter\MyAccountController@myaccount_password');
		Route::post('/waiter/myaccount/password/edit', 'Waiter\MyAccountController@myaccount_edit_password');
	});
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*---------- Dashboard ----------*/
		Route::get('order', 'Guest\OrderController@order_index');
		
		/*---------- Create Order ----------*/
		Route::get('/order/myorder', 'Guest\OrderController@order_myorder_index');
		Route::get('/order/filter/{filter}', 'Guest\OrderController@order_filter');
		Route::get('/order/myorder/filter/{filter}', 'Guest\OrderController@order_myorder_filter');
		Route::get('/order/datatables', 'Guest\OrderController@order_datatables');
		Route::get('/order/datatables/filter/{filter}', 'Guest\OrderController@order_filter_datatables');
		Route::get('/order/myorder/datatables', 'Guest\OrderController@order_myorder_datatables');
		Route::get('/order/myorder/datatables/filter/{filter}', 'Guest\OrderController@order_myorder_filter_datatables');
		Route::post('/order/{id}/add', 'Guest\OrderController@order_add');
		Route::post('/order/{id}/edit', 'Guest\OrderController@order_edit');
		Route::get('/order/delete', 'Guest\OrderController@order_delete');
		Route::post('/order/send', 'Guest\OrderController@order_send');

		/*---------- Create Transaction ----------*/
		Route::get('/transaction', 'Guest\TransactionController@transaction_index');
		Route::get('/transaction/datatables', 'Guest\TransactionController@transaction_datatables');
		Route::get('/transaction/update', 'Guest\TransactionController@transaction_update');

		/*---------- My Account ----------*/
		Route::get('/guest/myaccount', 'Guest\MyAccountController@myaccount_index');
		Route::post('/guest/myaccount/edit', 'Guest\MyAccountController@myaccount_edit');
		Route::get('/guest/myaccount/password', 'Guest\MyAccountController@myaccount_password');
		Route::post('/guest/myaccount/password/edit', 'Guest\MyAccountController@myaccount_edit_password');