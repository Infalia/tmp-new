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

Route::get('/', 'HomeController@index');

Route::get('404', 'ErrorPageController@page404');


/*** Initiatives ***/
Route::get('offers', 'InitiativeController@initiatives');
Route::get('offer/new', 'InitiativeController@initiativeForm')->middleware('uwumAuth');
Route::get('offer/edit/{id}/{title}', 'InitiativeController@initiativeEditForm')->middleware('curUserAuth');
Route::get('offer/comments', 'InitiativeController@initiativeComments');
Route::get('offer/{id}/{title}', 'InitiativeController@initiative');
Route::post('offer/save', 'InitiativeController@storeInitiative')->middleware('uwumAuth');
Route::post('offer/update/{id}', 'InitiativeController@updateInitiative')->middleware('curUserAuth');
Route::post('offer/delete/{id}', 'InitiativeController@deleteInitiative')->middleware('curUserAuth');
Route::post('offer/image/upload', 'InitiativeController@imageUpload')->middleware('uwumAuth');
Route::post('offer/image/remove', 'InitiativeController@imageRemove');
Route::post('offer/save/supporter', 'InitiativeController@storeInitiativeSupporter')->middleware('uwumAuth');
Route::post('offer/save/comment', 'InitiativeController@storeInitiativeComment')->middleware('uwumAuth');
Route::post('offer/save/ontomap', 'InitiativeController@storeInitiativeOnToMap')->middleware('uwumAuth');
Route::post('offer/update/ontomap/{id}', 'InitiativeController@updateInitiativeOnToMap')->middleware('curUserAuth');
Route::post('offer/delete/ontomap/{id}', 'InitiativeController@deleteInitiativeOnToMap')->middleware('uwumAuth');
Route::post('offer/ontomap/comment', 'InitiativeController@storeCommentOnToMap')->middleware('uwumAuth');
Route::post('offer/ontomap/supporter', 'InitiativeController@supporterOnToMap')->middleware('uwumAuth');


/*** Associations ***/
Route::get('associations', 'AssociationController@associations');
Route::get('association/register', 'AssociationController@associationForm')->middleware('uwumRoleAuth');
Route::post('association/save', 'AssociationController@storeAssociation')->middleware('uwumAuth');
Route::post('association/image/upload', 'AssociationController@imageUpload')->middleware('uwumAuth');
Route::post('association/image/remove', 'AssociationController@imageRemove');


/*** UWUM ***/
Route::post('uwum/check-user', 'UwumController@checkUser');

/*** UWUM authentication ***/
Route::get('login/uwum', 'Auth\UwumLoginController@redirectToUwumProvider');
Route::get('login/uwum/callback', 'Auth\UwumLoginController@handleUwumCallback');

/*** OnToMap ***/
Route::get('ontomap/get-events', 'OnToMapController@getUserEvents');
Route::get('ontomap/get-mappings', 'OnToMapController@getMappings');
Route::get('ontomap/send-mappings', 'OnToMapController@sendMappings');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    
    Route::get('/', function() {
        return redirect(url('admin/initiatives'));
    })->name('voyager.dashboard');
});
