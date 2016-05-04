<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
  public function books() {
    return $this->hasMany('\App\Book');
  }

  public static function authorsForDropdown() {

    # Get all the authors
    $authors = \App\Author::orderBy('last_name','ASC')->get();

    # Organize the authors into an array where the key = author id and value = author name
    $authors_for_dropdown = [];
    foreach($authors as $author) {
        $authors_for_dropdown[$author->id] = $author->last_name.', '.$author->first_name;
    }

    return $authors_for_dropdown;

  }
}
