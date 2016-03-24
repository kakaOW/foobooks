<?php


Route::group(['middleware' => ['web']], function () {
  Route::get('/', function () {
    return view('layouts.master');
  });

  Route::get('/books', 'BookController@getIndex');
  Route::get('/book/create', 'BookController@getCreate');
  Route::post('/book/create', 'BookController@postCreate');
  Route::get('/book/show/{title?}', 'BookController@getShow');

  Route::get('/practice', function() {

      $random = new Rych\Random\Random();
      return $random->getRandomString(8);

  });
});
