<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const BORRADOR = 1;
    const PUBLICADO = 2;


    // evitar que se llene por asigancion masiva
    protected $guaded = ['id', 'created_at', 'updated_at'];

    // relacion entre uno a muchos 
    public function sizes()
    {
        return $this->hasMany(Size::class);
    }
    // relacion inversa con productos con brads
    public function brands()
    {
        return $this->belongsTo(Brand::class);
    }

    // relacion inversa entre products y subcategory
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    // relacion muchos a muchos con colores
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    // realicion uno a muchos poliformica
    public function images()
    {
        return $this->morphMany(Image::class, "imageable");
    }

    /* url amigables */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
