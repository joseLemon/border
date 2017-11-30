<?php

/*
|--------------------------------------------------------------------------
| Mailer Routes
|--------------------------------------------------------------------------
|
*/

Route::post('mailer/contact', ['as' => 'mailer.contact', 'uses' => 'MailerController@sendContactMail']);