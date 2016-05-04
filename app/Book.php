<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title','autoher','published', 'cover', 'purchase_link'];
    public function author () {
        return $this->belongsTo('\App\Author');
    }
    public function tags()
    {
        # With timetsamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('\App\Tag')->withTimestamps();
    }
}
