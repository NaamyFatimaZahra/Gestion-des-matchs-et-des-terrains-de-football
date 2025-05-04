<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'terrain_id',
         'squad_id',
        'date_reservation',
        'heure_debut',
        'heure_fin',
        'status',     
        'reservationType',
        'payment_status', 
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function terrain()
    {
        return $this->belongsTo(Terrain::class)->where('deleted_at', null);
    }
    public function reservationUsers()
    {
        return $this->belongsToMany(User::class, 'reservation_users');
    }
}
