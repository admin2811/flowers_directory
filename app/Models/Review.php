<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $primaryKey="ReviewID";
    public $timestamps=false;
    protected $fillable=[
        "BookID",
        "UserID",
        "Rating",
        "ReviewText",
        "ReviewDate",
    ];
}
