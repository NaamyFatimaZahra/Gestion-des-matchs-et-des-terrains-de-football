<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'terrain_id',
        'date_reservation',
        'heure_debut',
        'heure_fin',
        'status',        
        'payment_status', 
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function terrain()
    {
        return $this->belongsTo(Terrain::class);
    }
    public function reservationUsers()
    {
        return $this->belongsToMany(User::class, 'reservation_users');
    }
}
