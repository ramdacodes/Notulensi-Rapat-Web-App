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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id('agenda_id');
            $table->string('name');
            $table->string('location');
            $table->date('date');
            $table->json('participants');
            $table->string('inviter_name');
            $table->string('inviter_position');
            $table->enum('status', ['not_started', 'ongoing', 'finished'])->default('not_started');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
