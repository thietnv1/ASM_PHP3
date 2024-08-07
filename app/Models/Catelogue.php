<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catelogue extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cover',
        'is_acvite'

    ];
    protected $casts = [
        'is_acvite'=>'boolean'
    ];
    public function products(){
        return $this->hasMany(Product::class);
    }
}
