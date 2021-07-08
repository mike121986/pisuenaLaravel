<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    // evitar que se llene por asigancion masiva
    protected $guaded = ['id','created_at','updated_at'];

    //relacion uno a muchos
    public function products(){
        return $this->hasMany(Product::class);
    }

    // relacion de uno amuchos inversa
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
