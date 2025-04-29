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
        Schema::create('usersquads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('squad_id')->constrained()->onDelete('cascade');
            $table->string('position')->nullable();
            $table->enum('side',['R','L'])->nullable();
            $table->boolean('admin')->default(false);
            $table->enum('acceptationUser', ['accepté', 'en attente', 'refusé'])->default('en attente');
            $table->enum('InvitationType',['admin','member'])->default('admin');
            $table->enum('equipe', ['1', '2'])->default('1');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usersquads');
    }
};
