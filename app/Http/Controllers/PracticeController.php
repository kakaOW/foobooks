<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class PracticeController extends Controller {

  public function getEx9() {

      $book = \App\Book::where('title','=','The Great Gatsby')->first();

      dump($book->tags);

      foreach($book->tags as $tag) {
        echo $tag->name.'<br />';
      }
  }
  public function getEx8() {

     # Get books from database
        $books = \App\Book::orderBy('id','desc')->get();

        # This gets the first book via another query
        #$book = \App\Book::orderBy('id','desc')->first();
        # This gets the first book by querying on the collection
        $book = $books->first();
        echo $book->title;
        # This shows how you can pass the $books collection
        # to the view to be looped through there
        #return view('practice.index')->with('books',$books);

  }

  public function getEx7() {
    # First get a book to delete
    $book = \App\Book::where('author', 'LIKE', '%Scott%')->first();

    # If we found the book, delete it
    if($book) {

        # Goodbye!
        $book->delete();

        return "Deletion complete; check the database to see if it worked...";

    }
    else {
        return "Can't delete - Book not found.";
}

  }
  public function getEx6() {
    # First get a book to update
    $book = \App\Book::where('author', 'LIKE', '%Scott%')->first();

    # If we found the book, update it
    if($book) {

        # Give it a different title
        $book->title = 'The Really Great Gatsby';

        # Save the changes
        $book->save();

        echo "Update complete; check the database to see if your update worked...";
    }
    else {
        echo "Book not found, can't update.";
}
  }
  public function getEx5() {

      $books = \App\Book::all();
      foreach($books as $book) {
        echo $book->title.'<br />';
      }
  }
  public function getEx4() {
    # Instantiate a new Book Model object
    $book = new \App\Book();

    # Set the parameters
    # Note how each parameter corresponds to a field in the table
    $book->title = 'Harry Potter';
    $book->author = 'J.K. Rowling';
    $book->published = 1997;
    $book->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
    $book->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

    # Invoke the Eloquent save() method
    # This will generate a new row in the `books` table, with the above data
    $book->save();

    echo 'Added: '.$book->title;
  }
  public function getEx2() {
    \DB::table('books')->insert([
      'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
      'title' => 'The Great Gatsby',
      'author' => 'F. Scott Fitzgerald',
      'published' => 1925,
      'cover' => 'http://img2.imagesbn.com/p/9780743273565_p0_v4_s114x166.JPG',
      'purchase_link' => 'http://www.barnesandnoble.com/w/the-great-gatsby-francis-scott-fitzgerald/1116668135?ean=9780743273565',
    ]);

    return 'Added book';
  }
  /**
  * Responds to requests to GET /books
  */
  public function getEx1() {
    // Use the QueryBuilder to get all the books
    $books = \DB::table('books')->get();

    // Output the results
    foreach ($books as $book) {
        echo $book->title;
    }

  }

}
