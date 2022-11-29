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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','App\Http\Controllers\Admin\AdminController@login');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function() {
	//Admin login Route
	Route::match(['get','post'],'login','AdminController@login');

	Route::group(['middleware'=>['admin']],function(){
		// Add New Admin / Staff
		Route::match(['get','post'],'add-admin','AdminController@addAdmin');
		//Admin Dashboard Route
		Route::get('dashboard','AdminController@dashboard');
		//Check Admin Password
		Route::post('check-admin-password','AdminController@checkAdminPassword');

		// Update Admin Password
		Route::match(['get','post'],'update-admin-password','AdminController@updateAdminPassword');
		// Update Admin Details
		Route::match(['get','post'],'update-admin-details','AdminController@updateAdminDetails');
		// View Admins/Staffs
		Route::get('admins/{type}','AdminController@admins');
		// Update Admin Status
		Route::post('update-admin-status','AdminController@updateAdminStatus');
		//Admin Logout Route
		Route::get('logout','AdminController@logout');

		//Frontend management

		//Homepage Banner
		Route::get('homepage-banner','PagemanagementController@hompageBanner');
		Route::match(['get','post'],'add-edit-homepage-banner/{id?}','PagemanagementController@addEditHompageBanner');
		Route::get('delete-homepage-banner/{id}','PagemanagementController@deleteHomepageBanner');

		//Homepage Advertisement
		Route::get('homepage-advertisement','PagemanagementController@homepageAdvertisement');
		Route::match(['get','post'],'add-edit-homepage-advertisement/{id?}','PagemanagementController@addEditHompageAdvertisement');
		Route::get('delete-homepage-advertisement/{id}','PagemanagementController@deleteHomepageAdvertisement');

		//Footer Banner
		Route::get('footer-banner','PagemanagementController@footerBanner');
		Route::match(['get','post'],'add-edit-footer-banner/{id?}','PagemanagementController@addEditFooterBanner');
		Route::get('delete-footer-banner/{id}','PagemanagementController@deleteFooterBanner');

		//Footer Advertisement
		Route::get('footer-advertisement','PagemanagementController@footerAdvertisement');
		Route::match(['get','post'],'add-edit-footer-advertisement/{id?}','PagemanagementController@addEditFooterAdvertisement');
		Route::get('delete-footer-advertisement/{id}','PagemanagementController@deleteFooterAdvertisement');

        //Social media
		Route::get('social-media','PagemanagementController@socialMediaManagement');
		Route::match(['get','post'],'add-edit-social-media/{id?}','PagemanagementController@addEditSocialMedia');
		Route::get('delete-social-media/{id}','PagemanagementController@deleteSocialmedia');

		//Footer Management
		Route::get('footer-management','PagemanagementController@footerManagement');
		Route::match(['get','post'],'add-edit-manage-footer/{id?}','PagemanagementController@addEditManageFooter');
		// END Frontend management


		// Route::get('delete-hotline-logo/{id}','PagemanagementController@deleteHotlineLogo');
		


		// Route::get('footer-management','PagemanagementController@footerManagement');
		// Route::get('footer-banner','PagemanagementController@footerBanner');
		// Route::get('footer-advertisement','PagemanagementController@footerAdvertisement');
		// Route::get('footer-cpoyright','PagemanagementController@footerCpoyright');
		// Route::get('social-media','PagemanagementController@socialMediaManagement');
		
		Route::post('update-subscriber-status','PagemanagementController@updateSubscriberStatus');
		Route::get('delete-subscriber/{id}','PagemanagementController@deleteSubscriber');


		//Customers
		Route::get('customers','CusromerController@customers');
		Route::post('add-customer','CusromerController@addCustomer');
		Route::post('update-customer-status','CusromerController@updateCustomerStatus');
		Route::get('view-customer-details/{id}','CusromerController@viewCustomerDetails');
		Route::get('delete-customer/{id}','CusromerController@deleteCustomer');

		//Subscriber
		Route::get('subscribers','CusromerController@subscribers');
		Route::post('update-subscriber-status','CusromerController@updateSubscriberStatus');
		Route::get('delete-subscriber/{id}','CusromerController@deleteSubscriber');

		//Sections
		Route::get('sections','SectionController@sections');
		Route::post('update-section-status','SectionController@updateSectionStatus');
		Route::get('delete-section/{id}','SectionController@deleteSection');
		Route::match(['get','post'],'add-edit-section/{id?}','SectionController@addEditSection');

		//Brands
		Route::get('brands','BrandController@brands');
		Route::post('update-brand-status','BrandController@updateBrandStatus');
		Route::get('delete-brand/{id}','BrandController@deleteBrand');
		Route::match(['get','post'],'add-edit-brand/{id?}','BrandController@addEditBrand');

		//Categories
		Route::get('categories','CategoryController@categories');
		Route::post('update-category-status','CategoryController@updateCategoryStatus');
		Route::match(['get','post'],'add-edit-category/{id?}','CategoryController@addEditCategory');
		Route::get('append-categories-level','CategoryController@appendCategoriesLevel');
		Route::get('delete-category/{id}','CategoryController@deleteCategory');
		Route::get('delete-category-image/{id}','CategoryController@deleteCategoryImage');

		//Product
		Route::get('products','ProductController@products');
		Route::post('update-product-status','ProductController@updateProductStatus');
		Route::match(['get','post'],'add-edit-product/{id?}','ProductController@addEditProduct');
		Route::match(['get','post'],'add-bulk-products/{download?}','ProductController@addBulkProducts')->name('BulkProductUpload');

		

		Route::get('delete-product/{id}','ProductController@deleteProduct');
		Route::get('delete-product-image/{id}','ProductController@deleteProductImage');
		Route::get('delete-product-video/{id}','ProductController@deleteProductVideo');

		// Product Collection
		Route::get('product-collection','ProductController@productCollection');
		Route::match(['get','post'],'add-edit-product-collection/{id?}','ProductController@addEditproductCollection');
		Route::get('delete-product-collection/{id}','ProductController@deleteProductCollection');



		//Product Filters
		Route::get('filters','FilterController@filters');
		Route::get('filter-values','FilterController@filterValues');
		Route::post('update-filter-status','FilterController@updateFilterStatus');
		Route::post('update-filter-value-status','FilterController@updateFilterValueStatus');
		
		//Attributes
		Route::get('attributes','ProductController@attributes');
		Route::get('add-attributes','ProductController@getAttributes');
		Route::post('add-attributes','ProductController@storeAttributes');
		Route::get('delete-attribute/{id}','ProductController@deleteAttribute');
		Route::get('add-attribute-value','ProductController@addAttrVal');

		Route::match(['get','post'],'set-attributes/{id?}','ProductController@setAttributes');
		Route::get('delete-set-attribute/{id}','ProductController@delete_attribute');
		// Route::get('get-set-attributes-ajax','ProductController@getAttributesAjax');
		
		// Route::delete('delete-attr/{id}', 'ProductController@delete_attr')->name('delete_attr');



		Route::match(['get','post'],'add-edit-attributes/{id?}','ProductController@addAttributes');
		Route::post('update-attribute-status','ProductController@updateAttributeStatus');
		Route::get('delete-attribute/{id}','ProductController@deleteAttribute');
		Route::post('update-attributes/{id}','ProductController@updateAttributes');

		//Images
		Route::match(['get','post'],'add-images/{id?}','ProductController@addImages');
		Route::post('update-image-status','ProductController@updateImageStatus');
		Route::get('delete-image/{id}','ProductController@deleteImage');

		//Orders
		Route::get('orders/{type}','OrderController@orders');
		Route::get('view-order-details/{id}','OrderController@viewOrderDetails');
		Route::post('order/change-status','OrderController@changeOrderStatus')->name('changeStatus');

		// Pos
		Route::get('pos','OrderController@pos');
		Route::post('cart-pos-product','OrderController@cartProduct');
		Route::post('cart-pos-product-update/{id}','OrderController@updateCartProduct');
		Route::get('cart-pos-product-remove/{id}','OrderController@removeCartProduct');
		Route::post('create-invoice','OrderController@createInvoice');
		Route::post('final-invoice','OrderController@finalInvoice');

		//Faqs & Faq Categories
		Route::get('faqs','FaqController@faqs');
		Route::post('update-faq-status','FaqController@updateFaqStatus');
		Route::match(['get','post'],'add-edit-faq/{id?}','FaqController@addEditFaq');
		Route::get('delete-faq/{id}','FaqController@deleteFaq');
		Route::get('faq-categories','FaqController@faqCategories');
		Route::post('update-faqCategory-status','FaqController@updateFaqCategoryStatus');
		Route::match(['get','post'],'add-edit-faq-category/{id?}','FaqController@addEditFaqCategory');
		Route::get('delete-faqCategory/{id}','FaqController@deleteFaqCategory');

		//Taxes
		Route::get('taxes','TaxController@taxes');
		Route::post('update-tax-status','TaxController@updateTaxStatus');
		Route::match(['get','post'],'add-edit-tax/{id?}','TaxController@addEditTax');
		Route::get('delete-tax/{id}','TaxController@deleteFaq');
		//Shjipping Charges
		Route::get('shipping-rules','ShippingController@shippingRules');
		Route::post('update-shippingRule-status','ShippingController@updateShippingRuleStatus');
		Route::match(['get','post'],'add-edit-shippingRule/{id?}','ShippingController@addEditShippingRule');
		Route::get('delete-shippingRule/{id}','ShippingController@deleteShippingRule');
	});
});
