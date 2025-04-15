<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'terrain_id',
        'user_id',
        'content',
        'rating',
        'deleted_at',
    ];

    public function terrain()
    {
        return $this->belongsTo(Terrain::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
