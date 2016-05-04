<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller {

  /**
  * Responds to requests to GET /books
  */
  public function getIndex() {

    $books = \App\Book::with('author')->orderBy('id','desc')->get();

    return view('books.index')->with('books', $books);
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
    $authors_for_dropdown = \App\Author::authorsForDropdown();

    $tags_for_checkboxes = \App\Tag::getTagsForCheckboxes();

    return view('books.create')->with([
    'authors_for_dropdown' => $authors_for_dropdown,
    'tags_for_checkboxes' => $tags_for_checkboxes
    ]);
  }

  /**
  * Responds to requests to POST /books/create
  */
  public function postCreate(Request $request) {

    // dd($request->all());
    $this->validate($request, [
    'author'        => 'required|min:5',
    'published'     => 'required|min:4',
    'cover'         => 'required|url',
    'purchase_link' => 'required|url',
    ]);

    // Add the book to database
    // $book = new \App\Book();
    // $book->title = $request->title;
    // $book->author = $request->author;
    // $book->published = $request->published;
    // $book->cover = $request->cover;
    // $book->purchase_link = $request->purchase_link;
    // $book->save();

    // Mass Assignment
    $data = $request->only('title','author','published', 'cover', 'purchase_link');
    $book = new \App\Book($data);
    $book->save();

    // Mass Assignment 2
    // $data = $request->only('title','author','published', 'cover', 'purchase_link');
    // \App\Book::create($data);


    \Session::flash('message','Your book was added');

    //return 'Add the book: '.$request->title;
    return redirect('/books');
  }

  public function getEdit($id = null) {

    $book = \App\Book::with('tags')->find($id);

    $authors_for_dropdown = \App\Author::authorsForDropdown();

    # Get all the possible tags so we can include them with checkboxes in the view
    $tags_for_checkboxes = \App\Tag::getTagsForCheckboxes();
    /*
    Create a simple array of just the tag names for tags associated with this book;
    will be used in the view to decide which tags should be checked off
    */
    $tags_for_this_book = [];
    foreach($book->tags as $tag) {
        $tags_for_this_book[] = $tag->id;
    }
    # Results in an array like this: $tags_for_this_book['novel','fiction','classic'];
    # Make sure $authors_for_dropdown is passed to the view
    return view('books.edit')->with([
        'book' => $book,
        'authors_for_dropdown' => $authors_for_dropdown,
        'tags_for_checkboxes' => $tags_for_checkboxes,
        'tags_for_this_book' => $tags_for_this_book,
    ]);

  }

  public function postEdit(Request $request) {

    $book = \App\Book::find($request->id);

    $book->title = $request->title;
    $book->author_id = $request->author_id;
    $book->cover = $request->cover;
    $book->published = $request->published;
    $book->purchase_link = $request->purchase_link;

    if($request->tags) {
      $tags = $request->tags;
    }
    else {
      $tags =[];
    }

    $book->Tags()->sync($tags);

    $book->save();

    \Session::flash('message','Your book was updated');

    return redirect('/book/edit/'.$request->id);

  }
}
