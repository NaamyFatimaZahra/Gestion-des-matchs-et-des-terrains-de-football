<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('terrains', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->foreignId('proprietaire_id')->references('id')->on('users')->onDelete('cascade');
    $table->integer('capacity')->nullable();
    $table->decimal('price', 10, 2);
    $table->enum('status', ['disponible', 'occupé', 'maintenance', 'en_attente'])->default('en_attente');
    $table->enum('admin_approval',  ['en_attente', 'approuve', 'rejete','suspended'])->default('en_attente');
    $table->integer('reservation_count')->default(0); 
    $table->text('description');
    $table->enum('payment_method', ['en_ligne', 'sur_place', 'les_deux']);
        $table->enum('surface', [
        'gazon_naturel',        
        'gazon_synthetique',   
        'gazon_hybride',        
        'turf_artificiel',     
        'stabilise',            
        'sable',             
        'beton',               
        'terre_battue',        
        'indoor_synthetique',
        'altra_resist',        
    ]);
    $table->string('city');
    $table->string('adress');
    $table->decimal('latitude', 10, 8)->nullable();
    $table->decimal('longitude', 10, 8)->nullable();
    $table->string('contact');
    $table->timestamps();
    $table->softDeletes();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terrains');
    }
};
