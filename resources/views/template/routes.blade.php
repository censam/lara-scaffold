//{{$names->TableName()}} Resources
/*******************************************************/
@if ($names->PanelType()=='public')
Route::resource('{{$names->TableNameSingle()}}','{{$names->TableName()}}Controller');
Route::post('{{$names->TableNameSingle()}}/{id}/update','{{$names->TableName()}}Controller@update');
Route::get('{{$names->TableNameSingle()}}/{id}/delete','{{$names->TableName()}}Controller@destroy');
Route::get('{{$names->TableNameSingle()}}/{id}/deleteMsg','{{$names->TableName()}}Controller@DeleteMsg');
 @else
Route::resource('{{$names->PanelType()}}/{{$names->TableNameSingle()}}', '{{$names->TableName()}}Controller');
Route::post('{{$names->PanelType()}}/{{$names->TableNameSingle()}}/{id}/update', ['as' => '{{$names->TableNameSingle()}}_update', 'uses' => '{{$names->TableName()}}Controller@update']);
Route::get('{{$names->PanelType()}}/{{$names->TableNameSingle()}}/{id}/delete', ['as' => '{{$names->TableNameSingle()}}_delete', 'uses' => '{{$names->TableName()}}Controller@destroy']);
Route::get('{{$names->PanelType()}}/{{$names->TableNameSingle()}}/{id}/deleteMsg', ['as' => '{{$names->TableNameSingle()}}_delete_msg', 'uses' => '{{$names->TableName()}}Controller@DeleteMsg']); 
 @endif 
/********************************************************/
