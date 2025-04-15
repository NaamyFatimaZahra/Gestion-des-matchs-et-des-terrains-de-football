<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terrain extends Model
{
    use SoftDeletes;
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
        'contact',
        'deleted_at'
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
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    // public function reservations(){
    //     return $this->hasMany(Reservation::class);
    // }
}
