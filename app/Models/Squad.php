<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Squad extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name_sqaud',
        'city',
        'formation'
    ];

    /**
     * Relation avec l'utilisateur propriétaire
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les joueurs du squad (si vous avez cette relation)
     */
    public function players()
    {
        return $this->belongsToMany(Player::class)
                    ->withPivot('position') // Si vous stockez la position du joueur dans le squad
                    ->withTimestamps();
    }
}