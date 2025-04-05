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
        'verified',
        'active',
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

    public function terrain(){
          return $this->belongsToMany(Terrain::class,'terrain_service');
    }


     public function Documents(){
        return $this->hasMany(Document::class);
    }
}
