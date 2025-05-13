<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable=[
           'id',
           'terrain_id',
           'photo_path',
           
    ];

    public function terrain(){
        return $this->belongsTo(Terrain::class);
    }
}
