<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable=[
        'id',
        'name'
    ];

    public function terrain(){
          return $this->belongsToMany(Terrain::class,'terrain_service');
    }

    
}
