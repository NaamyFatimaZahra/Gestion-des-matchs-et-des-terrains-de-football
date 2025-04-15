<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terrain extends Model
{
   
    protected $fillable = [
        'name',
        'proprietaire_id',
        'capacity',
        'price',
        'status',
        'admin_approval',
        'reservation_count',
        'description',
        'payment_method',
        'surface',
        'city',
        'adress',
        'latitude',
        'longitude',
        'contact'
    ];

    public function services(){
          return $this->belongsToMany(Service::class,'terrain_service')->withPivot('price');
    }
    public function  proprietaire(){
        return $this->belongsTo(User::class);
    }


     public function Documents(){
        return $this->hasMany(Document::class);
    }
}
