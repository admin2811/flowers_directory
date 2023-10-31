<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $fillable = [
        'flower_id',
        'region_name',
    ];
    public function flower(){
        return $this->belongsTo(Flower::class);
    }
}
