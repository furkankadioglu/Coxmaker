<?php

Route::group(array('module' => 'CoxTable', 'middleware' =>  ['web', 'auth'], 'namespace' => 'App\Modules\CoxTable\App\Http\Controllers'), function() {

    // CoxTable - Settings
    Route::put('/admin/modules/CoxTable/settings/', array('uses' => 'CoxTableAdminSettingsController@update', 'as' => 'admin.CoxTable.settings.update'));
    Route::post('/admin/modules/CoxTable/settings/', array('uses' => 'CoxTableAdminSettingsController@store', 'as' => 'admin.CoxTable.settings.store'));

    Route::get('/admin/modules/CoxTable/settings/{id}/delete', array('uses' => 'CoxTableAdminSettingsController@destroy', 'as' => 'admin.CoxTable.settings.destroy'));
    Route::get('/admin/modules/CoxTable/settings/create', array('uses' => 'CoxTableAdminSettingsController@create', 'as' => 'admin.CoxTable.settings.create'));
    Route::get('/admin/modules/CoxTable/settings/', array('uses' => 'CoxTableAdminSettingsController@index', 'as' => 'admin.CoxTable.settings.index'));

    // CoxTable - Admin
    Route::post('/admin/modules/CoxTable/', array('uses' => 'CoxTableAdminController@store', 'as' => 'admin.CoxTable.store'));
    Route::put('/admin/modules/CoxTable/{id}', array('uses' => 'CoxTableAdminController@update', 'as' => 'admin.CoxTable.update'));

    Route::get('/admin/modules/CoxTable', array('uses' => 'CoxTableAdminController@index', 'as' => 'admin.CoxTable.index'));
    Route::get('/admin/modules/CoxTable/{id}/delete', array('uses' => 'CoxTableAdminController@destroy', 'as' => 'admin.CoxTable.destroy'));
    Route::get('/admin/modules/CoxTable/{id}/edit', array('uses' => 'CoxTableAdminController@edit', 'as' => 'admin.CoxTable.edit'));
    Route::get('/admin/modules/CoxTable/create', array('uses' => 'CoxTableAdminController@create', 'as' => 'admin.CoxTable.create'));
    Route::get('/admin/modules/CoxTable/{id}', array('uses' => 'CoxTableAdminController@show', 'as' => 'admin.CoxTable.show'));
});	

Route::group(array('module' => 'CoxTable', 'middleware' =>  ['web', 'api'], 'namespace' => 'App\Modules\CoxTable\App\Http\Controllers'), function() {
    Route::resource('CoxTableAPI', 'CoxTableApiController');
});

Route::group(array('module' => 'CoxTable', 'middleware' =>  ['web'], 'namespace' => 'App\Modules\CoxTable\App\Http\Controllers'), function() {

	// CoxTable - Visitor
    Route::get('/CoxTable/', array('uses' => 'CoxTableController@index', 'as' => 'admin.CoxTable.index'));
    Route::post('/CoxTable/', array('uses' => 'CoxTableController@store', 'as' => 'admin.CoxTable.store'));
    Route::get('/', array('uses' => 'CoxTableController@index', 'as' => 'admin.CoxTable.index'));
    Route::get('/CoxTable/{key}/', array('uses' => 'CoxTableController@show', 'as' => 'admin.CoxTable.show'));
    Route::get('/CoxTable/{key}/{userId}', array('uses' => 'CoxTableController@updateData', 'as' => 'admin.CoxTable.updateData'));




});	