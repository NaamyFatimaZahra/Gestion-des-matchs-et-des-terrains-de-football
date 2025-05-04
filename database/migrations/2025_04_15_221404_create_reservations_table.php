<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('terrain_id')->constrained()->onDelete('cascade');
            $table->date('date_reservation');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->enum('reservationType',['group','local']);
           
            $table->foreignId('squad_id')->nullable()->references('id')->on('squads')->onDelete('cascade');
            $table->enum('status', ['confirmee', 'en_attente', 'annulee', 'terminee'])->default('en_attente');
            $table->enum('payment_status', ['payee', 'non_payee'])->default('non_payee');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};