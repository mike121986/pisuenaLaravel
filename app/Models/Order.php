<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // este tipo de invacion masiva es para decir cuales son los campos que no usare yo
   protected $guarded = ['id','created_at','updated_at','status'];

    /* constantes */
    const PENDIENTE = 1;
    const RECIBIDO = 2;
    const ENVIADO = 3;
    const ENTREGADO = 4;
    const ANULDO = 5;

    // relacion uno a mucho inversa

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
