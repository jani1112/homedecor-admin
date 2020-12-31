<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Product Categories
    Route::post('product-categories/media', 'ProductCategoryApiController@storeMedia')->name('product-categories.storeMedia');
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Product Tags
    Route::apiResource('product-tags', 'ProductTagApiController');

    // Products
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Sub Categories
    Route::post('sub-categories/media', 'SubCategoriesApiController@storeMedia')->name('sub-categories.storeMedia');
    Route::apiResource('sub-categories', 'SubCategoriesApiController');

    // Featured Products
    Route::apiResource('featured-products', 'FeaturedProductsApiController');

    // Offer Products
    Route::apiResource('offer-products', 'OfferProductsApiController');

    // Manager Coupons
    Route::apiResource('manager-coupons', 'ManagerCouponsApiController');

    // Feedback Views
    Route::apiResource('feedback-views', 'FeedbackViewApiController', ['except' => ['store', 'update']]);

    // Manage Orders
    Route::apiResource('manage-orders', 'ManageOrdersApiController');
});
