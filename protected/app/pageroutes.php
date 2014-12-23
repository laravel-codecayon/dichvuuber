<?php 
Route::get('service', 'HomeController@page')->where(array('id'=>'[0-9]+'));
Route::get('pages/gioi-thieu-{id}.html', 'HomeController@page')->where(array('id'=>'[0-9]+'));
Route::get('contact-us', 'HomeController@page')->where(array('id'=>'[0-9]+'));
?>