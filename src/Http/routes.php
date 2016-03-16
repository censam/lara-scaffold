<?php
/*
|--------------------------------------------------------------------------
| Where the main app (LaraScaffold) routes
|--------------------------------------------------------------------------
|
 */
Route::group(['middleware' => 'web'], function () {

    Route::get('scaffold', '\Censam\LaraScaffold\Http\Controllers\GuiController@index');

    Route::post('scaffold/guipost', '\Censam\LaraScaffold\Http\Controllers\GuiController@store');

    Route::get('scaffold/guirollback/{id}', '\Censam\LaraScaffold\Http\Controllers\GuiController@destroy');

    Route::get('scaffold/guidelete/{id}', '\Censam\LaraScaffold\Http\Controllers\GuiController@deleteMsg');

    Route::get('scaffold/getAttributes/{table}', '\Censam\LaraScaffold\Http\Controllers\GuiController@GetResult');

    Route::get('scaffold/scaffoldHomePage', '\Censam\LaraScaffold\Http\Controllers\GuiController@homePage');

    Route::get('scaffold/scaffoldHomePageIndex', '\Censam\LaraScaffold\Http\Controllers\GuiController@getIndex');

    Route::get('scaffold/scaffoldHomePageDelete', '\Censam\LaraScaffold\Http\Controllers\GuiController@homePageDelete');

    Route::get('scaffold/migrate', '\Censam\LaraScaffold\Http\Controllers\GuiController@migrate');

    Route::get('scaffold/rollback', '\Censam\LaraScaffold\Http\Controllers\GuiController@rollback');
});
