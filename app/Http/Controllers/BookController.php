<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller {

  /**
  * Responds to requests to GET /books
  */
  public function getIndex() {
    return view('books.index');
  }

  /**
  * Responds to requests to GET /books/show/{id}
  */
  public function getShow($title = null) {
    return view('books.show')->with('title', $title);
    // return view('books.show',['title' => $title]);
  }

  /**
  * Responds to requests to GET /books/create
  */
  public function getCreate() {

    // $view = '<form method="POST" action="/book/create">';
    // $view .= csrf_field();
    // $view .= 'Book title: <input type="text" name="title">';
    // $view .= '<input type="submit">';
    // $view .= '</form>';
    //
    // return $view;
    return view('books.create');
  }

  /**
  * Responds to requests to POST /books/create
  */
  public function postCreate(Request $request) {

    // dd($request->all());
    $this->validate($request, [
      'title' => 'required|min:3',
      'author' => 'required',
    ]);

    return 'Add the book: '.$request->input('title');
    // return redirect('/books');
  }
}
