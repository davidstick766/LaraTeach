<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('welcome');

Route::get('/login', 'Auth/AuthController@login');
Route::get('/campaigns', 'CampaignController@index');

//Admin Routes for Publisher
Route::get('/admin/publisher', 'AdminController@indexPublisher');
Route::get('/admin/publisher/create', 'AdminController@createPublisherAsUser');
Route::post('/admin/publisher/create', 'AdminController@storePublisherAsUser')->name('create-publisher1');
Route::post('/admin/publisher/create/2', 'AdminController@storePublisher')->name('create-publisher2');
Route::get('/admin/publisher/edit/{id}', 'AdminController@editPublisher');
Route::post('/admin/publisher/update/{id}', 'AdminController@updatePublisher')->name('edit-publisher');
Route::get('/admin/publisher/show/{id}', 'AdminController@showPublisher');
Route::delete('/admin/publisher/delete/{id}', 'AdminController@destroyPublisher');
Route::get('/admin/advertiser/{id}/add-credits', function () {
    return view('admin.addAdvertiserCredit');
});
Route::patch('/admin/advertiser/{id}/add-credits', 'AdminController@addCredits');

//Campaign Integration
Route::get('/campaigns/public', 'CampaignController@createCampaign');
Route::post('/campaigns', 'CampaignController@storeCampaign');
Route::get('/campaigns/edit/{id}', 'CampaignController@editCampaign');
Route::patch('/campaigns/update/{id}', 'CampaignController@updateCampaign');
Route::delete('/campaigns/{id}', 'CampaignController@destroyCampaign');

//Payment Integration
Route::post('/pay', 'AdvertiserController@initialize')->name('pay');
Route::get('/pay/callback', 'AdvertiserController@callback')->name('callback');
Route::get('/campaigns/pay', 'AdvertiserController@pay');


Route::post('/campaigns', 'CampaignController@index');
Route::post('/campaigns/public', 'CampaignController@create');
Route::get('/campaigns/public', 'CampaignController@show');
Route::patch('/campaigns/edit/{id}', 'CampaignController@edit');
Route::delete('/campaigns/delete/{id}', 'CampaignController@destroy');

Route::get('/campaign-history/{id}', 'CampaignController@campaignhistory');



//Transaction History - Advertiser

Route::get('/transaction-history/{id}', 'AdvertiserController@paymentHistory');

//This route is for testing purpose....it shouldnt have a route of its own
Route::get('/balance/{id}', 'UserController@walletBalance');

//Route for publisher pages
Route::get('/publisher/transactions', 'PublisherController@viewAllTransactions');
Route::get('/publisher/transactions/{transaction}', 'PublisherController@viewTransaction');
Route::get('/publisher/bank-account/create', 'PublisherController@createBankAccountInfo');
Route::post('/publisher/bank-account', 'PublisherController@storeBankAccountInfo');
Route::get('/publisher/update-profile', 'PublisherController@createUpdateProfile');
Route::post('/publisher/update-profile', 'PublisherController@updateProfile');

// Publisher request withdrawal request route
Route::get('/publisher/withdrawal/create', 'WithdrawalController@createPublisherWithdrawal');
Route::post('/publisher/withdrawal', 'WithdrawalController@storePublisherWithdrawal');
//Publisher Filter campaign category
Route::get('/publisher/filter-campaign-category/create', 'PublisherController@createFilterCampaignCategory');
Route::post('/publisher/filter-campaign-category', 'PublisherController@filterCampaignCategory');


//Admin Route for advertisers
Route::get('/admin', 'AdminController@index');
Route::get('/admin/create', 'AdminController@create');
Route::post('/admin', 'AdminController@store');
Route::get('/admin/{id}', 'AdminController@show');
Route::get('/admin/{id}/edit', 'AdminController@edit');
Route::put('/admin/{id}', 'AdminController@update');
Route::delete('/admin/{id}', 'AdminController@destroy');


//super admin
Route::get('/super-admin', 'SuperAdminController@index');
Route::post('/super-admin', 'SuperAdminController@create');
Route::get('/super-admin/admin', 'SuperAdminController@showAll');
Route::post('/super-admin/admin', 'SuperAdminController@create');
Route::get('/super-admin/admin/{id}', 'SuperAdminController@show');
Route::get('/super-admin/admin/remove/{id}', 'SuperAdminController@destroy');



Auth::routes(['verify' => true]);


