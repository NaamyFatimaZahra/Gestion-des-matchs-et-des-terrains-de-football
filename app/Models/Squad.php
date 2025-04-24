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
        'name_squad',
        'city',
        'formation'
    ];

    /**
     * Relation avec l'utilisateur propriétaire
     */
    public function players()
    {
        return $this->belongsToMany(User::class,'usersquads')
            ->withPivot('position', 'admin', 'acceptationUser', 'equipe')
            ->withTimestamps();
    }
    public function isAdmin($userId)
{
    return $this->players()
        ->wherePivot('admin', true)
        ->where('user_id', $userId)
        ->exists();
}

   
}