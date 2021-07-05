<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    // asignacion masiva
    protected $fillable = ['name','product_id'];

    // relacion inversa uno a muchos 
    public function products(){
        return $this->belongsTo(Product::class);
    }

    // relcion muchos a muchos con color
    public function colors(){
        return $this->belongsToMany(Color::class);
    }



}
