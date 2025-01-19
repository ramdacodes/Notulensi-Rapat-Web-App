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
        Schema::create('presences', function (Blueprint $table) {
            $table->id('presence_id');
            $table->foreignId('agenda_id')
                ->constrained('agendas', 'agenda_id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('nidn')->nullable();
            $table->string('nim')->nullable();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
