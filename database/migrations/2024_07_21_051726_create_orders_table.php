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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('rank_id')->constrained('rank')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('paket_id')->constrained('pakets')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->string('rank_awal');
            $table->string('rank_tujuan');
            $table->string('bintang');
            $table->string('catatan')->nullable();
            $table->string('req_hero');
            $table->string('email');
            $table->string('password');
            $table->string('methode_login');
            $table->text('no_wa');
            $table->enum('order_status',['pending','in progress','complete','canceled'])->default('pending');
            $table->enum('payment_status',['pending','complete','failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
