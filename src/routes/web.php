<?php

// Welcome
Route::get('/', 'WelcomeController@landingPage')->name('welcome');

// Contacts
Route::get('/contacts', 'ContactController@index')->name('contact.index');
Route::get('/contacts/importer', 'ContactController@importer')->name('contact.importer');
Route::post('/upload-file', 'ContactController@uploadFile')->name('contact.upload.file');
Route::post('/store-contacts', 'ContactController@storeContacts')->name('contact.store.contacts');
