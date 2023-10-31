<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Flower extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image_url',
    ];
    public function regions(){
        return $this->hasMany(Region::class);
    }
}
