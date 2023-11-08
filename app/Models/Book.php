<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $primaryKey = "BookID";
    public $timestamp = false;
    protected $fillable = [
        "Title",
        "Author",
        "Genre",
        "PublicationYear",
        "ISBN",
        "CoverImageURL"
    ];
}
