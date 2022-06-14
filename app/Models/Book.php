<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'author',
        'year',
        'publisher',
        'synopsis',
    ];

    public function bookCategory()
    {
        return $this->belongsTo(BookCategory::class);
    }

    public function bookGalleries() {
        return $this->hasMany(BookGallery::class);
    }

    public function transaction() {
        return $this->hasMany(Transaction::class);
    }
}
